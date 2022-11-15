<?php

namespace App\Http\Controllers\Employee;

use App\Models\Application;
use App\Models\Contract;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use ArPHP\I18N\Arabic;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $employee_id = Auth::user()->id;
        $employee = Employee::FindOrFail($employee_id);
        $data = Contract::query()->where('employee_id', $employee_id)->paginate('10');
        return view('employee.contracts.index', compact('employee', 'employee_id', 'data'));
    }

    public function show($id)
    {
        $contract = Contract::FindOrFail($id);
        return view('employee.contracts.show', compact('contract'));
    }

    public function show_application_details(Request $request)
    {
        $application_id = $request->application_id;
        $application = Application::FindOrFail($application_id);
        echo "<table class='table table-bordered table-condensed table-striped'>";
        echo "<tr>";
        echo "<td>" . trans('main.employee_name') . "</td>";
        echo "<td>" . $application->offer->employee_name . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.date') . "</td>";
        echo "<td>" . $application->date . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.application_type') . "</td>";
        echo "<td>" . trans('main.' . $application->application_type . '') . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.dept_name') . "</td>";
        if (App::getLocale() == "ar") {
            echo "<td>" . $application->dept->dept_name_ar . "</td>";
        } else {
            echo "<td>" . $application->dept->dept_name_en . "</td>";
        }
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.project_name') . "</td>";
        if (App::getLocale() == "ar") {
            echo "<td>" . $application->project->project_name_ar . "</td>";
        } else {
            echo "<td>" . $application->project->project_name_en . "</td>";
        }
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.supervisors') . "</td>";
        echo "<td>";
        foreach ($application->job_titles as $job_title) {
            if (App::getLocale() == "ar") {
                echo "- " . $job_title->job_title->job_title_ar;
                echo "<br/>";
            } else {
                echo "- " . $job_title->job_title->job_title_en;
                echo "<br/>";
            }
        }
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.basic_salary') . "</td>";
        echo "<td>" . $application->basic_salary . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.identity_residency_number') . "</td>";
        echo "<td>" . $application->identity_number . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.status') . "</td>";
        echo "<td>";
        if ($application->status == "waiting") {
            echo '<span class="badge badge-md badge-warning">' . trans('main.' . $application->status . '') . '';
        } elseif ($application->status == "approved") {
            echo '<span class="badge badge-md badge-success">' . trans('main.' . $application->status . '') . '';
        } elseif ($application->status == "declined") {
            echo '<span class="badge badge-md badge-danger">' . trans('main.' . $application->status . '') . '';
        }
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . trans('main.created_at') . "</td>";
        echo "<td>" . $application->created_at . "</td>";
        echo "</tr>";
        echo "</table>";
    }

    public function print($id)
    {
        $Arabic = new Arabic();
        $today = date('Y-m-d');

        $contract = Contract::FindOrFail($id);
        $start_date = $contract->start_date;

        $today = date('Y-m-d');
        $pdf = new TCPDF("P", "px", "A4", true, "UTF-8");
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->setImageScale(1);
        $lg = array();
        $lg['a_meta_charset'] = 'UTF-8';
//        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        $pdf->AddPage();
        $pdf->setPageOrientation('P');
        $pdf->setPageUnit('px');
        $pdf->setRTL(true);
        $pdf->SetFont('almohanad', '', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Image('assets/img/contract-start.png', '0', '0', '', '', '', '', 'C', false, 300, '', false, false, 0, false, false, false);
        $pdf->SetFontSize(14);
        $pdf->writeHTMLCell(0, 0, 430, 50, "الرقم التسلسلى : ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 520, 45, $contract->id, 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 30, 140, "إنه في يوم", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(14);
        $start_date_str = strtotime($contract->start_date);
        $start_date_hijri = $Arabic->date('j F Y', $start_date_str);
        $pdf->writeHTMLCell(0, 0, 85, 140, $start_date_hijri, 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 170, 140, "الموافق", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 220, 135, $start_date, 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 300, 140, "تم الاتفاق بين كلا من:-", 0, 1, 0, true, 'D', true);

        $style = array('color' => array(68, 108, 168), 'width' => 2);
        $pdf->Line(25, 160, 570, 160, $style);
        $pdf->writeHTMLCell(0, 0, 30, 160, "الطرف الأول:", 0, 1, 0, true, 'D', true);

        $pdf->SetFont('almohanad', '', 16);
        $pdf->setCellHeightRatio(0.9);
        $text = "شركة دار البناء للمقاولات، وهي شركة مسجلة وقائمة وتزاول نشاطها بموجب السجل التجاري رقم: [1010072219]، وعنوانها [الرياض - حي الروضة شارع أبي الدرداء] ص. ب [26588] الرمز البريدي [13213]، جوال رقم: [0114455103]، فاكس رقم: [0112787970]، بريد إلكتروني: com.daralbena@hr ، ويمثلها في هذا العقد المدير التنفيذي (ويشار إليها فيما يلي باسم «صاحب العمل»). ";
        $pdf->writeHTMLCell(540, 0, 30, 175, $text, 0, 1, 0, true, 'D', true);

        $pdf->Line(25, 245, 570, 245, $style);
        $pdf->writeHTMLCell(0, 0, 30, 245, "الطرف الثانى:", 0, 1, 0, true, 'D', true);
        $pdf->SetFont('almohanad', '', 12);
        $pdf->writeHTMLCell(0, 0, 30, 260, "الموظف/ـة : ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 120, 260, " [ " . $contract->employee_name . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 280, 260, " , " . " [ " . $contract->nationality->nationality_ar . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 330, 260, " الجنسية", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 275, " ويحمل بطاقة هوية رقم ", 0, 1, 0, true, 'D', true);
        $pdf->SetFont('almohanad', '', 20);
        $pdf->writeHTMLCell(0, 0, 140, 270, " [ " . $contract->identity_number . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);

        $pdf->writeHTMLCell(0, 0, 280, 275, " ، جواز رقم  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFont('almohanad', '', 20);
        $pdf->writeHTMLCell(0, 0, 330, 270, " [ " . $contract->passport_number . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);

        $pdf->writeHTMLCell(0, 0, 30, 290, " وعنوانه ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 70, 290, " [ " . $contract->employee_address . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 380, 290, " جوال رقم:  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFont('almohanad', '', 20);
        $pdf->writeHTMLCell(0, 0, 430, 285, " [ " . $contract->phone_number . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);

        $pdf->writeHTMLCell(0, 0, 30, 305, " وجوال اخر ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 120, 300, " [ " . $contract->another_phone_number . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 280, 305, "   البريد الالكترونى :  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 380, 300, " [ " . $contract->email . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);

        $pdf->writeHTMLCell(0, 0, 30, 320, "  (ويشار إليه فيما يلي باسم (الموظف/ـة). ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 335, " ويشار إلى كل منهما على حدة بـ \"طرف\" وإليهما معاً بـ \"الطرفين\" وبعد أن أقر الطرفان بأهليتهما المعتبرة شرعاً ونظاماً لإبرام هذا العقد، فقد اتفقا على ما يلي: ", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 370, 570, 370, $style);
        $pdf->writeHTMLCell(0, 0, 30, 370, " مكان العمل: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 385, " [الرياض] أو أي مكان آخر يقرره صاحب العمل من وقت لآخر.  ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 400, " قبول الموظف بالعمل بموقع صاحب العمل في (الرياض)، ويحق لصاحب العمل نقل الموظف إلى أي فرع أو موقع من الفروع أو المواقع التابعة حسب مصلحة العمل، ويلتزم الموظف بقبول العمل الذي يوكله إليه صاحب العمل في أي مكان في المملكة، وإذا اقتضت مصلحة العمل من جانب الموظف السفر داخل وخارج المملكة للعمل يلزمه تنفيذ وتحقيق الواجبات الموكلة له لإنجاز العمل، كما لصاحب العمل تكليفه بالعمل في إحدى الشركات التي يمتلكها أو يمتلك نسبة فيها، بشرط ألا يختلف العمل فيها اختلافا جوهريا عن عمله الأصلي. ", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 465, 570, 465, $style);
        $pdf->writeHTMLCell(0, 0, 30, 465, " المركز الوظيفى : ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 480, " اتفق الطرفان على أن يعمل الموظف لدى صاحب العمل تحت إدارته وإشرافه في مدينة [الرياض]، المملكة العربية السعودية بوظيفة  : ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 495, " [ " . $contract->job_title->job_title_ar . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 120, 495, " ومباشرة الأعمال التي يُكلف بها بما يتناسب مع قدراته العملية والعلمية والفنية وفقاً لاحتياجات العمل وبما لا ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 510, "يتعارض مع الضوابط المنصوص عليها في المواد (الثامنة والخمسون والتاسعة الخمسون والستون) من نظام العمل. ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 525, "يحق لصاحب العمل توجيه المهام التي يراها مناسبة للموظف في أي مكان وأي وقت داخل المملكة ضمن حدود مهنته أو وظيفته المتفق عليها بالعقد.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 560, 570, 560, $style);
        $pdf->writeHTMLCell(0, 0, 30, 560, " نوع العقد: ", 0, 1, 0, true, 'D', true);
        $period = $contract->contract_period;
        $pdf->writeHTMLCell(0, 0, 30, 575, " مدة هذا العقد  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 90, 570, $period, 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 100, 575, " سنة ميلادية ، تبدأ من مباشرة الموظف للعمل في تاريخ  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 340, 570, $contract->start_date, 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 400, 575, " وتنتهي في تاريخ  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 480, 570, $contract->end_date, 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 30, 590, "ينتهي هذا العقد بانتهاء مدته، وفي حال رغبة أحد الأطراف في إنهاء العقد قبل ذلك فيكون بـ", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 605, "أ- يشعر صاحب العمل الموظف كتابياً عن طريق البرنامج المعتمد بالشركة أو الايميل في رغبته بالإنهاء بـ ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 455, 600, " ( 60 ) ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 485, 605, " ستين يوما ", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 620, "ب- يشعر الموظف صاحب العمل كتابياً عن طريق البرنامج المعتمد بالشركة أو الايميل في رغبته بالإنهاء بـ ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 460, 615, " ( 90 ) ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 485, 620, " تسعين يوما ", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 635, "وفي حال تركه العمل دون مراعاة مدة الاشعار أعلاه فيلتزم بتعويض صاحب العمل بأن يدفع له ما يعادل أجر ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 460, 630, " ( 90 ) ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 485, 635, " تسعين يوما ", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 655, 570, 655, $style);
        $pdf->writeHTMLCell(0, 0, 30, 655, " فترة التجربة: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 670, " يخضع الموظف لفترة تجربة مدتها تسعين  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 200, 665, " ( 90 ) ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 230, 670, " ) يوماً وتبدأ من تاريخ مباشرته للعمل ولا يدخل في حساب فترة التجربة إجازة عيدي ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 685, "الفطر والأضحى والإجازة المرضية، وفي أثناء فترة التجربة: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 700, "أ- يكون لصاحب العمل فقط الحق في الانهاء دون توجيه إشعار مسبق أو سداد أي تعويض.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 715, "ب- في حال رغبة الموظف في إنهاء العقد خلال فترة التجربة يتم توجيه إشعار لصاحب العمل قبل ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 410, 710, " ( 15 ) ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 440, 715, "يوم من تاريخ الإنهاء؛", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 730, "ويجوز للطرفين الاتفاق بالتراضي فيما بينهما على تمديد فترة التجربة لمدة إضافية قدرها ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 400, 725, " ( 90 ) ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 440, 730, " يوما ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 755, " وفي حال إنهاء العقد خلال فترة التجربة، لا يحق للموظف الحصول على أي تعويض أو إجازة أو مكافأة نهاية الخدمة. ", 0, 1, 0, true, 'D', true);

        $basic_salary_text = $Arabic->int2str($contract->basic_salary);
        $total_salary_text = $Arabic->int2str($contract->total_salary);
        $housing_allowance_text = $Arabic->int2str($contract->housing_allowance);
        $transport_allowance_text = $Arabic->int2str($contract->transport_allowance);
        $another_allowance_text = $Arabic->int2str($contract->another_allowance);

        $pdf->AddPage();
        $pdf->setPageOrientation('P');
        $pdf->setPageUnit('px');
        $pdf->setRTL(true);
        $pdf->SetFont('almohanad', '', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Image('assets/img/contract.png', '0', '0', '', '', '', '', 'C', false, 300, '', false, false, 0, false, false, false);
        $pdf->SetFontSize(12);
        $pdf->setCellHeightRatio(1);
        $pdf->writeHTMLCell(0, 0, 30, 100, " الأجر الأساسي: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 115, " يدفع صاحب العمل للموظف أجراً أساسياً قــدره: ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 30, 125, " [ " . $contract->basic_salary . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 70, 130, "( ريال سعودى )", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 150, 130, " [ " . $basic_salary_text . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 230, 130, "( ريال سعودى )", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 145, "كما يلتزم صاحب العمل بمنح الموظف البدلات والمزايا التالية : ", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 160, "بدل سكن قــدره: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 110, 160, $housing_allowance_text, 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 190, 160, "( ريال سعودى )", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 175, "بدل نقل قــدره: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 110, 175, $transport_allowance_text, 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 190, 175, "( ريال سعودى )", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 190, "بدلات اخرى قــدرها: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 150, 190, $another_allowance_text, 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 230, 190, "( ريال سعودى )", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 205, "وبذلك يكون مجموع ما يتقاضاه العامل شهرياً هو:", 0, 1, 0, true, 'D', true);

        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 30, 215, " [ " . $contract->total_salary . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 70, 220, "( ريال سعودى )", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 150, 220, " [ " . $total_salary_text . " ] ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 230, 220, "( ريال سعودى )", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 30, 235, "ويتم سداده في نهاية كل شهر ميلادي.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 255, 570, 255, $style);
        $pdf->writeHTMLCell(0, 0, 30, 260, "ساعات العمل العادية:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 270, "تحدد ساعات العمل العادية بـ ", 0, 1, 0, true, 'D', true);

        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 160, 265, " ( 48 ) ", 0, 1, 0, true, 'D', true);

        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 190, 270, " ثمانيةٌ وأربعون ساعة عمل أسبوعياً. ", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 290, 570, 290, $style);
        $pdf->writeHTMLCell(0, 0, 30, 295, "الإجازة السنوية:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 310, " يستحق الموظف إجازة سنوية مدفوعة الأجر مدتها  ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(20);
        $pdf->writeHTMLCell(0, 0, 235, 305, " ( 21 ) ", 0, 1, 0, true, 'D', true);

        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(0, 0, 260, 310, " يوماً، إضافة لأيام العطل الرسمية التي تعلن عنها الحكومة السعودية للعاملين ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 325, " بالقطاع الخاص والتي تصادف أيام عمل رسمي. يجب على الموظف طلب اجازته السنوية والتمتع بها في سنة الاستحقاق ولا يحق له بأي شكل من الأشكال ترحيلها للسنة التالية وإلا تعتبر لاغية، ولا يجوز له أن يتقاضى بدل نقدي عوضاً عن الحصول عليها، و يجوز لصاحب العمل تحديد تاريخ بداية الإجازة السنوية للموظف حسب مقتضيات العمل، و إذا وجه أحد الطرفين إنذاراً بإنهاء الخدمة جاز لصاحب العمل أن يطلب من الموظف استعمال أيام الإجازة المستحقة له أثناء مهلة الإنذار، و إذا كان الموظف وقت إنهاء خدمته قد استعمل أيام إجازة أكثر من ما يستحقه حتى تاريخ الإنهاء، جاز لصاحب العمل أن يقتطع من المبالغ المستحقة للموظف مبلغاً يعادل أجر أيام الإجازة الزائدة عن مستحقات العامل ", 0, 1, 0, true, 'D', true);

        $pdf->Line(25, 420, 570, 420, $style);
        $pdf->writeHTMLCell(0, 0, 30, 425, "التأمين الطبي:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 440, "يلتزم صاحب العمل بتوفير الرعاية الطبية للموظف بالتأمين الصحي، وفقاً لأحكام نظام الضمان الصحي التعاوني.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 460, 570, 460, $style);

        $pdf->writeHTMLCell(0, 0, 30, 465, "شروط العمل:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 480, "إن هذا العقد وخدمة الموظف مشروطان بما يلي:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 495, "أ- أن يكون الموظف لائقاً طبياً للعمل في المملكة. ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 510, "ب- استلام صاحب العمل مراجع توظيف سابقة وشهادات للموظف يرى أنها كافية وتفي بالحاجة.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 525, "صرّح الموظف وتعهد لصاحب العمل بأنه لا يترتب على إبرام هذا العقد أو تنفيذ التزاماته المنصوص عليها فيه أي مخالفة لأي أمر قضائي أو أي شرط صريح أو ضمني في أي عقد أو أي التزام آخر ملزم له، بما في ذلك على سبيل المثال لا الحصر أي مهلة إنذار أو أي شرط خاص بأي تعهدات تقييدية أو التزامات تتعلق بسرية المعلومات أو بالملكية الفكرية الناشئة عن أي عمل له لدى أي صاحب عمل آخر أو صاحب عمل سابق.", 0, 1, 0, true, 'D', true);

        $pdf->Line(25, 590, 570, 590, $style);
        $pdf->writeHTMLCell(0, 0, 30, 595, "الواجبات:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 30, 610, "يلتزم الموظف طوال مدة خدمته بالمسائل الآتية:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 625, "أ- أن يلتزم بحسن السلوك والأخلاق أثناء العمل وفي جميع الأوقات يلتزم بالأنظــــــمة والأعراف والعــــادات والآداب المرعية في المملكة العربية السعودية وكذلك بالــقواعد و اللوائح و التعلـــيمات المعمــــول بها لدى صاحب العمل و يتــــحمل كافة الغرامات المالية الناتجة عن مخالفته لتلك الأنظمة. ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 660, "ب- أن ينجز العمل الموكل إليه وفقاً لأصول المهنة، و وفق تعليمات صاحب العمل إذا لم يكن في هذه التعليمات ما يخالف العقد أو النظام أو الآداب العامة ولم يكن في تنفيذها ما يُعرضه للخطر.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 685, "ت- يحظر على الموظف العمل لدى الغير سواء بأجر أو بدون أجر بأي حال من الأحوال وذلك أثناء فترة العقد، ويحظر العمل لدى المنافس في مجال المقاولات بعد انتهاء العلاقة العمالية لمدة سنتين داخل المملكة العربية السعودية.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 710, "ث- أن يعتني عناية كافية بالأجهزة والمعدات والآلات والأدوات المسلمة له بطبيعة عمله المملوكة لصاحب العمل والموضوعة تحت تصرفه أو التي تكون في عهدته وأن يعيدها إلى صاحب العمل غير مستهلكة، وفي حال تسلمه لسيارة فإنه يتحمل المخالفات المسجلة عليها خلال فترة حيازته لها.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 750, "ج- أن يقدم كل العون والمساعدة دون أن يشترط لذلك أجراً إضافياً في حالات الأخطار التي تهدد سلامة مكان العمل أو الأشخاص العاملين فيه.", 0, 1, 0, true, 'D', true);

        $pdf->AddPage();
        $pdf->setPageOrientation('P');
        $pdf->setPageUnit('px');
        $pdf->setRTL(true);
        $pdf->SetFont('almohanad', '', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Image('assets/img/contract.png', '0', '0', '', '', '', '', 'C', false, 300, '', false, false, 0, false, false, false);
        $pdf->SetFontSize(12);
        $pdf->setCellHeightRatio(1);

        $pdf->writeHTMLCell(540, 0, 30, 100, "ح- أن يخضع وفقاً لطلب صاحب العمل للفحوص الطبية التي يرغب في إجرائها عليه قبل الالتحاق بالعمل أو أثناءه للتحقق من خلوه من الأمراض المهنية أو السارية.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 130, "خ- التقيد بكافة القواعد والسياسات والإجراءات التي تعتمدها الشركة من وقت لآخر.", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(540, 0, 30, 145, "د- الحفاظ على كافة الشهادات والمؤهلات المهنية والقيود اللازمة لتمكينه من تنفيذ مهام عمله بموجب هذا العقد بصورة قانونية.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 160, "ذ- تكريس كامل وقته واهتمامه وقدراته لأعمال الشركة، ما لم يصب بحالة عجز تحول دون قدرته على ذلك.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 175, "ر- التقيد بكافة التوجيهات المشروعة قانوناً الصادرة عن صاحب العمل.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 190, "ز- بذل كل ما في وسعه في تعزيز وحماية وتطوير وتوسيع نطاق أعمال الشركة وتعزيز سمعتها التجارية، واستعمال كافة الصلاحيات وتنفيذ كافة المهام التي يوكله صاحب العمل بها من وقت لآخر بمنتهى الإخلاص والعناية.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 220, 570, 220, $style);

        $pdf->writeHTMLCell(540, 0, 30, 225, "المعلومات السرية:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 240, "أقر الموظف وأدرك بأنه سيكون على اطلاع على المعلومات السرية.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 255, "يمتنع الموظف عن المسائل الآتية:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 270, "أ- الكشف عن المعلومات السرية لأي شخص أو شركة أو هيئة أو جمعية أو أي كيان آخر لأي سبب من الأسباب باستثناء الوكلاء المفوضين أصولاً من صاحب العمل أو أي كيان من الكيانات التابعة له؛ أو", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 295, "ب- استخدام أو استغلال المعلومات السرية لأغراضه الخاصة أو لأغراض الغير؛ أو", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 310, "ج- إبداء أي تعليقات مسيئة أو تشهيرية حول الشركة أو أي من عملائها أو استشارييها أو مدرائها أو موظفيها أو مسؤوليها أو شركائها أو مساهميها أو مورديها أو وكلائها الحاليين أو السابقين (الأشخاص ذوي الصلة)، ولا يجوز له القيام بأي شيء يترتب عليه الإساءة لسمعة الشركة أو أي شخص من الأشخاص ذوي الصلة؛ أو", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 350, "د- عمل أي نسخ أو سجل أو مذكرة بشأن أي من المعلومات السرية.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 365, "أقر الموظف بأن حكم هذا البند الخاص بمبدأ السرية يبقى سارياً أثناء العقد، ولمدة لا تقل عن خمسة عشر سنة بعد إنهاء أو إنتهاء هذا العقد في المملكة العربية السعودية، الرياض، فيما يخص أعمال المقاولات وماله صلة بها.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 400, 570, 400, $style);

        $pdf->writeHTMLCell(540, 0, 30, 405, "الإشعارات:", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 420, "تكون الاشعارات الموجهة بموجب هذا العقد مكتوبة وموقعة من الطرف الذي وجهه أو من ينوب عنه وتُرسل على العناوين الموضحة في صدر هذا العقد أو عن طريق البرنامج المعتمد بالشركة. وفي حال تم تغيير عناوين البريد الإلكتروني المعنية دون اشعار، سيتم اعتبار عناوين البريد الإلكتروني المذكورة أعلاه إخطاراً صحيحاً بموجب هذا العقد.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 465, 570, 465, $style);

        $pdf->writeHTMLCell(540, 0, 30, 470, "الاعتراضات :", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 485, "يكون الاعتراض على قرارات صاحب العمل على سبيل المثال لا الحصر الإنذارات والخصومات بالراتب وغيره أو تطبيق أي جزاء على الموظف خلال 30 يوم تُرسل على العناوين الموضحة في صدر العقد أو عن طريق البرنامج المعتمد بالشركة، وسكوت الموظف خلال هذه المدة دون إبداء أي اعتراض رسمي يعتبر بمثابة موافقة ضمنية منه على القرار، وفي حال اعتراضه خلال المدة النظامية يتم تشكيل لجنة داخل الشركة للنظر في سبب القرار والاعتراض المقدم.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 540, 570, 540, $style);
        $pdf->writeHTMLCell(540, 0, 30, 545, " التكاليف والحوافز: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 560, "1- في حال تكليف الموظف بالعمل خارج أوقات العمل الرسمي يشترط أن يكون التكليف معتمد من المدير التنفيذي بخطاب رسمي بتوقيع وختم الشركة أو بإيميل رسمي من المدير التنفيذي، ولا يعتد بأي توجيه شفهي أو تكليف من غير المدير التنفيذي، ويكون اثبات الحضور بنظام البصمة.", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 600, "2- الاتفاقات المالية بين أطراف العقد كالمكافئات أو الحوافز وغيرها، لا تقبل ولا يعمل بها إلا إذا كانت مكتوبة بشكل رسمي وموقعة بين الطرفين وممهورة بختم الشركة.", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 630, 570, 630, $style);

        $pdf->writeHTMLCell(540, 0, 30, 635, " التغييرات وملحقات عقد العمل: ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 650, " 1- لا يعتد بأي تغيير على هذا العقد ما لم يكن مكتوباً وموقعاً من كل طرف. ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 665, " 2- إن أي ملحقات للعقد يتم إبرامها بموافقة الطرفين هي جزء لا يتجزأ من هذا العقد. ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 680, " 3- يقر الموظف بأنه اطلع على لائحة تنظيم العمل الداخلية للشركة وعلى علم ببنودها، وأنها من ملحقات العقد. ", 0, 1, 0, true, 'D', true);
        $pdf->Line(25, 700, 570, 700, $style);

        $pdf->writeHTMLCell(540, 0, 30, 710, " بنود اضافية: ", 0, 1, 0, true, 'D', true);

        $pdf->AddPage();
        $pdf->setPageOrientation('P');
        $pdf->setPageUnit('px');
        $pdf->setRTL(true);
        $pdf->SetFont('almohanad', '', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Image('assets/img/contract.png', '0', '0', '', '', '', '', 'C', false, 300, '', false, false, 0, false, false, false);
        $pdf->SetFontSize(12);
        $pdf->setCellHeightRatio(1);
        $pdf->SetFontSize(14);
        $pdf->writeHTMLCell(540, 0, 30, 100, " القانون الواجب التطبيق والاختصاص القضائي: ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(12);
        $pdf->writeHTMLCell(540, 0, 30, 125, " 1- يخضع هذا العقد وكل منازعة أو مطالبة تنشأ عنه أو تتعلق به أو بمحله أو بإنشائه (بما في ذلك المنازعات والمطالبات غير التعاقدية) وتفسر جميعها وفقاً للأنظمة المعمول بها في المملكة العربية السعودية، بما فيها نظام العمل ولائحته التنفيذية وأي قرارات صادرة أو قد تصدر بشأن نظام العمل ولائحته التنفيذية.   ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 170, " 2- وافق الطرفان موافقة لا رجعة فيها على أن تكون الجهات المُختصة المعنية بنظر القضايا العمالية في المملكة العربية السعودية بمدينة الرياض صاحبة الاختصاص القضائي الحصري في نظر وتسوية كل منازعة أو مطالبة تنشأ عن هذا العقد أو تتعلق به أو بمحله أو بإنشائه (بما في ذلك المنازعات والمطالبات غير التعاقدية). ", 0, 1, 0, true, 'D', true);
        $pdf->SetFontSize(14);
        $pdf->writeHTMLCell(540, 0, 30, 240, " يدخل هذا العقد حيز التنفيذ اعتباراً من المباشرة الفعلية للموظف، وقد اطلع الموظف على شروط وأحكام هذا العقد وفهمها ووافق عليها، كما وافق على تقديم كافة المستندات التي تقضي سياسات صاحب العمل بتقديمها. ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(540, 0, 30, 310, " وتوثيقاً لما تقدم، قام الطرفان بالتوقيع على هذا العقد بنسختين أصليتين استلم كل طرف نسخة منه للعمل بموجبها، ", 0, 1, 0, true, 'D', true);

        $pdf->SetFontSize(15);
        $pdf->writeHTMLCell(0, 0, 140, 370, " الطرف الأول ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 320, 370, " الطرف الثاني ", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 140, 400, " ---------------------- ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 320, 400, " ---------------------- ", 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 140, 430, " المدير التنفيذي ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 320, 430, $contract->employee_name, 0, 1, 0, true, 'D', true);

        $pdf->writeHTMLCell(0, 0, 140, 460, " التوقيع : ", 0, 1, 0, true, 'D', true);
        $pdf->writeHTMLCell(0, 0, 320, 460, "  التوقيع : ", 0, 1, 0, true, 'D', true);


        $pdf->Image('assets/img/signature.png', 350, 450, 120, 80, '', '', 'C', false, 300, '', false, false, 0, false, false, false);

        $pdf->Image($contract->employee_signature, 150, 500, 120, 120, '', '', 'C', false, 300, '', false, false, 0, false, false, false);

        $pdf->Image('assets/img/stamp.png', 350, 550, 150, 100, '', '', 'C', false, 300, '', false, false, 0, false, false, false);

        $full_path = public_path('uploads\contracts\\') . 'contract_' . $contract->id . '.pdf';
        $pdf->Output($full_path, 'F');
        return response()->file($full_path);
    }

    public function contract_approved(Request $request)
    {
        // employee_signature
        $contract = Contract::FindOrFail($request->contract_id);
        $folderPath = 'public/uploads/signature/';
        $image = explode(";base64,", $request->signed);
        $image_type = explode("image/", $image[0]);
        $image_type_png = $image_type[1];
        $image_base64 = base64_decode($image[1]);
        $file = $folderPath . uniqid() . '.'.$image_type_png;
        file_put_contents($file, $image_base64);
        $contract->update([
            'status' => 'approved',
            'employee_signature' => $file
        ]);
        return redirect()->route('employee.contracts.show',$contract->id)
            ->with('success', trans('main.contract_approved'));
    }
}
