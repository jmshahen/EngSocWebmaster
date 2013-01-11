'''
CSV File: (comma separated) 
Directorship, Directors, Emails
Arts - Colouring Contest, bob, bob@uwaterloo.ca
Arts - Cortyrty, bob, bob@uwaterloo.ca
Arts - awesome, bob, bob@uwaterloo.ca
, bob2, bob2@uwaterloo.ca				<-- means two directors for Arts - Awesome
Arts - dsfgdfg Contest, bob, bob@uwaterloo.ca
.
.
.
'''
import csv

folder = "C:\\Work\\EngSoc\\Directorship\\"
filenames = [1,1]
filenames[1] = "Bsoc directors.csv"
filenames[0] = "Asoc directors.csv"

str = """
<?php global $user; $authenticated = isset($_COOKIE['recaptcha_human']) && $_COOKIE['recaptcha_human']=="1";
	if((int)$user->uid != 0 || $authenticated):
?>
<p>The activities and services of the Engineering&nbsp;Society are coordinated almost entirely by volunteers.&nbsp; Click on the directorship names below to find out more about our available positions.&nbsp;If you are interested in filling a vacant directorship, please contact the appropriate exec member.&nbsp; Applications for all directorships open at the end of each term.</p>
<p>Click here for <a href="#asoc">A-Soc</a> or <a href="#bsoc">B-Soc</a>.</p>
<p><a name="asoc"></a>
"""

links = {}
links['Alumni Officer'] = '/node/3612'
links['Arts'] = '/node/3652'
links['Athletics'] = '/node/3653'
links['Canada Day'] = '/node/3634'
links['Charities'] = '/node/3635'
links['Co-op Rep'] = '/node/3675'
links['Competitions'] = '/node/3636'
links['Course Critiques'] = '/node/3624'
links['CRO Assistant'] = '/node/3642'
links['E-Council Rep'] = '/node/3672'
links['Enginuity'] = '/node/3660'
links['EngPlay'] = '/node/3676'
links['Environmental'] = '/node/3661'
links['Exchange'] = '/node/3637'
links['Frosh Mentoring'] = '/node/3626'
links['Genius Bowl'] = '/node/3663'
links['Halloween'] = '/node/3629'
links['Historian'] = '/node/3614'
links['Interfaculty Rep'] = '/node/3641'
links['Iron Warrior Editor'] = '/node/3678'
links['Jazz Band'] = '/node/3664'
links['Music'] = '/node/3666'
links['Novelties'] = '/node/3650'
links['Off-Term Rep'] = '/node/3617'
links['P**5'] = '/node/3667'
links['PD Rep'] = '/node/3627'
links['POETS Manager'] = '/node/3618'
links['Resume Critiques'] = '/node/3628'
links['Santa Claus Parade'] = '/node/3662'
links['Scavenger Hunt'] = '/node/3657'
links['Secretary'] = '/node/3668'
links['Semi-Formal'] = '/node/3669'
links['Senate'] = '/node/3679'
links['SFF Rep'] = '/node/3630'
links['Shadow Day'] = '/node/3645'
links['Special Events'] = '/node/3670'
links['Student Life 101'] = '/node/3646'
links['Student Workshops'] = '/node/3624'
links['TalEng'] = '/node/3671'
links['TSN - EOT Video'] = '/node/3673'
links['Year Spirit'] = '/node/3677'
links['Webmaster'] = '/node/3674'
links['WEEF Director'] = '/node/3680'
links['WEEF Assistant'] = '/node/3681'
links['Women in Engineering Rep'] = '/node/3647'

b = 0
for filename in filenames:
        print "Opening: " + folder + filename
        directors = csv.reader(open(folder + filename, 'rb'))

        i = 0
        str += '<table width="100%" cellspacing="0" cellpadding="0" border="1" style="border: 1px solid rgb(255, 255, 255); text-align: center; min-width: 700px;">\n<tbody>\n<tr style="background-color: rgb(255, 182, 10);"><td width="50%" style="text-align: center;"><span style="font-weight: bold;">Directorship</span></td><td style="text-align: center;" colspan="2">'

        if b == 0: # Top row
                str += '<strong>A-Soc Winter 2012</strong></td></tr>\n'
        else:   # bottome row
                str += '<strong>B-Soc Spring 2012</strong></td></tr>\n'

        pre = ''

        for row in directors:
                if i == 0:
                        i += 1
                        continue
                
                # Headings
                # print row
                if len(row[0]) != 0 and len(row[1]) == 0 and len(row[2]) == 0:
                        if row[0] in links:
                                str += "<tr style='background-color: rgb(221, 221, 221);'><td colspan='3' align='left'><b><a target='_blank' href='" + links[row[0]] + "'>" + row[0] + "</a></b></td></tr>\n"
                        else:
                                str += "<tr style='background-color: rgb(221, 221, 221);'><td colspan='3' align='left'><b>" + row[0] + "</b></td></tr>\n"
                        # pre = '&nbsp;&nbsp;'
                elif len(row[0]) == 0 and len(row[1]) == 0 and len(row[2]) == 0:
                        pre = ''
                        str += "<tr><td colspan='3'>&nbsp;</td></tr>\n"
                else:
                        if row[2] == "[VACANT]":
                                name = row[2]
                        else:
                                name = "<a href='mailto:" + row[2] + "'>"+ row[2] +"</a>"
                        
                        if row[0] in links:
                                str += "<tr><td>" + pre + "<a target='_blank' href='" + links[row[0]] + "'>" + row[0] + "</a></td><td>" + row[1] + "</td><td>" + name + "</td></tr>\n"
                        else:
                                str += "<tr><td>" + pre + row[0] + "</td><td>" + row[1] + "</td><td>" + name +"</td></tr>\n"

        str += "</tbody></table></p>"
        if b == 0:
                b += 1
                str += """
<p class="rteright">&nbsp;<a href="#">Top &uarr;</a></p>
<p><a name="bsoc"></a>
"""

str += """
<?php else: ?>
<p>The activities and services of the Engineering&nbsp;Society are coordinated almost entirely by volunteers. In order to access this list of volunteers (and to prove that you are human), please fill in the CAPTCHA below:</p>
<?php require_once('/u1/engsoc/public_html/recaptcha/include.php'); endif; ?>
"""

print str
raw_input('...')

f = open('C:\\Work\\EngSoc\\Directorship\\directors.html', 'w')
# f = open('C:\\Work\\EngSoc\\Directorship\\result_asoc.html', 'w')

f.write(str)
f.close()
