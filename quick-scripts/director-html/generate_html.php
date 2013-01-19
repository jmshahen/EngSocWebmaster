<?php
function generate_html($file_handle, $stream, $term, $year)
{
$str = '
<?php global $user; $authenticated = isset($_COOKIE[\'recaptcha_human\']) && $_COOKIE[\'recaptcha_human\']=="1";
	if((int)$user->uid != 0 || $authenticated):
?>
<p>The activities and services of the Engineering&nbsp;Society are coordinated almost entirely by volunteers.&nbsp; Click on the directorship names below to find out more about our available positions.&nbsp;If you are interested in filling a vacant directorship, please contact the appropriate exec member.&nbsp; Applications for all directorships open at the end of each term.</p>
<p>Click here for <a href="#asoc">A-Soc</a> or <a href="#bsoc">B-Soc</a>.</p>
<p><a name="asoc"></a>
';

$links = array(
        'Arts'                      => '/node/3652',
        'Alumni Officer'            => '/node/3612',
        'Athletics'                 => '/node/3653',
        'Canada Day'                => '/node/3634',
        'Charities'                 => '/node/3635',
        'Co-op Rep'                 => '/node/3675',
        'Competitions'              => '/node/3636',
        'Course Critiques'          => '/node/3624',
        'CRO Assistant'             => '/node/3642',
        'E-Council Rep'             => '/node/3672',
        'Enginuity'                 => '/node/3660',
        'EngPlay'                   => '/node/3676',
        'Environmental'             => '/node/3661',
        'Exchange'                  => '/node/3637',
        'Frosh Mentoring'           => '/node/3626',
        'Genius Bowl'               => '/node/3663',
        'Halloween'                 => '/node/3629',
        'Historian'                 => '/node/3614',
        'Interfaculty Rep'          => '/node/3641',
        'Iron Warrior Editor'       => '/node/3678',
        'Jazz Band'                 => '/node/3664',
        'Music'                     => '/node/3666',
        'Novelties'                 => '/node/3650',
        'Off-Term Rep'              => '/node/3617',
        'P**5'                      => '/node/3667',
        'PD Rep'                    => '/node/3627',
        'POETS Manager'             => '/node/3618',
        'Resume Critiques'          => '/node/3628',
        'Santa Claus Parade'        => '/node/3662',
        'Scavenger Hunt'            => '/node/3657',
        'Secretary'                 => '/node/3668',
        'Semi-Formal'               => '/node/3669',
        'Senate'                    => '/node/3679',
        'SFF Rep'                   => '/node/3630',
        'Shadow Day'                => '/node/3645',
        'Special Events'            => '/node/3670',
        'Student Life 101'          => '/node/3646',
        'Student Workshops'         => '/node/3624',
        'TalEng'                    => '/node/3671',
        'TSN - EOT Video'           => '/node/3673',
        'Year Spirit'               => '/node/3677',
        'Webmaster'                 => '/node/3674',
        'WEEF Director'             => '/node/3680',
        'WEEF Assistant'            => '/node/3681',
        'Women in Engineering Rep'  => '/node/3647'
);


$str .= "<table width='100%' cellspacing='0' cellpadding='0' style='border: 1px solid rgb(255, 255, 255); text-align: center; min-width: 700px;'>\n<tbody>\n<tr style='background-color: rgb(255, 182, 10);'><td width='50%' style='text-align: center;'><span style='font-weight: bold;'>Directorship</span></td><td style='text-align: center;' colspan='2'>";

$str .= "<strong>$stream-Soc $term $year</strong></td></tr>\n";
$pre = '';


$i = 0;

$heading_style = "align='left' style='padding: 10px 0 2px 0; font-weight:bold;'";
while (!feof($file_handle) ) {
        $row = fgetcsv($file_handle, 1024);

        // Skip first row of the CSV
        if($i == 0) {
            $i += 1;
            continue;
        }

        if ($row[2] == "[VACANT]")
                $name = $row[2];
        else
                $name = "<a href='mailto:" . $row[2] . "'>". $row[2] ."</a>";

        //Executive
        if($row[3] == "1") {
                $str .= "<tr style='background-color: rgb(221, 221, 221);'><td $heading_style>";
                if (isset($links[$row[0]]))
                        $str .= "<a target='_blank' href='" . $links[$row[0]] . "'>" . $row[0] . "</a>";
                else
                        $str .= $row[0];
                $str .= "</td><td $heading_style>" . $row[1] . "</td><td $heading_style>" . $name . "</td></tr></tr>\n";
                # $pre = '&nbsp;&nbsp;'
        }
        //Spacer - empty row in the CSV
        else if(strlen($row[0]) == 0 and strlen($row[1]) == 0 and strlen($row[2]) == 0) {
                $pre = '';
                $str .= "<tr><td colspan='3'>&nbsp;</td></tr>\n";
        }
        else {
                if (isset($links[$row[0]]))
                        $str .= "<tr><td>" . $pre . "<a target='_blank' href='" . $links[$row[0]] . "'>" . $row[0] . "</a></td><td>" . $row[1] . "</td><td>" . $name . "</td></tr>\n";
                else
                        $str .= "<tr><td>" . $pre . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $name ."</td></tr>\n";
        }
}

$str .= "</tbody></table></p>";
if ($stream == 'A') {
        $str .= '
<p class="rteright">&nbsp;<a href="#">Top &uarr;</a></p>
<p><a name="bsoc"></a>
';
}

$str .= "
<?php else: ?>
<p>The activities and services of the Engineering&nbsp;Society are coordinated almost entirely by volunteers. In order to access this list of volunteers (and to prove that you are human), please fill in the CAPTCHA below:</p>
<?php require_once('/u1/engsoc/public_html/recaptcha/include.php'); endif; ?>
";

return $str;
}
?>