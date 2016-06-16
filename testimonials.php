<?php 

require_once('admin/conn/DB.php');

include('admin/conn/tablefuncs.php');

mysql_select_db($database_DB, $ravcodb);

session_start();



$pagetitle = "Positive Notes From Our Customers - Best Name Badges";

$metadescription = "";

$metakeywords = "name badges, name tags, custom name badge, custom name tags, metal name tags, brushed aluminum name badges, plastic name tags, plastic name badges, color name badges, employee name tags, employee name badges, professional name tags, professional name badges"; 

?>

<?php 

if ($_SESSION["customerloginid"])

{

	include_once 'inc/header-auth.php';

} else {

	//include_once 'inc/header.php' ;
	include_once 'inc/header_new.php' ;

} ?>



  <div id="hero">

    <div id="heroHeader">

    	

    </div>

    <div id="heroButton"></div>

  </div><!-- end hero -->

  

  <div id="content">

    <div id="leftColumn">

      <?php
      include_once 'inc/leftcolumn3.php' ; 
      ?>

    </div><!-- end leftColumn -->

    

    <div id="mainContent">
    	
	<div class="subright flr">
					  <h2>What Our Customers Have To Say.</h2>
				
				  		<h4>Completely <em>unsolicited</em> testimonials from some of our satisfied customers.</h4>
				
				      <p>We take  pride in our business and the service that we offer.  We live by our core values every single day.  We use the best materials available, the strongest magnets, the newest machines that are expertly maintained daily, and have a commitment to quality customer service that rivals any 5-star hotel.</p>
				
				      <p>We never ask for testimonials, but we get them daily. Below is a collection of unsolicited testimonials sent in by our happy customers.  We hope to see your kind words here too someday.</p>
				
				      <br /><br />
				 <hr />
                 <p>"Love, love, love the name tag! Awesome design for me to wear at my temp jobs! Thank you!"</p>
				
				<p style="text-align: right;"><strong>H. Redfield</strong></p>
                
                <hr />
                 
                  <p>"Mark Kuiper was very helpful and accommodating with our name badge order.  Even with extraordinary shipping requests, and tight timeframes, the order was processed quickly and completed without errors.  It’s not often you encounter a company with exceptional service and attention to customers, and in this particular case that is exactly what we received- excellent service and customer attention.  It’s very much appreciated!  Thank you!"</p>
				
				<p style="text-align: right;"><strong>T. Define</strong></p>
                
                <hr />
                 
                  <p>"Every time I have needed help, Mark has always been there to answer any questions or concerns. If what I want is not available, Mark will offer an alternative solution. Very Helpful! Thank you!"</p>
				
				<p style="text-align: right;"><strong>T. Bell, Nolensville Historical Society</strong></p>
                
                <hr />
                 
                  <p>"I was a real pain in the...... and you were VERY patient, helping me to get things correct so we would be satisfied with end product. Thanks"</p>
				
				<p style="text-align: right;"><strong>L. Norris, Island County</strong></p>
                
                
                 <hr />
                 
                  <p>"Riel has been extremely patient with me during our ordering process. Even after several questions and changes, Riel remained courteous, professional and helpful. Thanks Riel! "</p>
				
				<p style="text-align: right;"><strong>D. Posey, Galilee Baptist Church</strong></p>
                
                
                
                 <hr />
                 
                  <p>"Very professional, quick response time, and exceptional communication via E-mail! The gold standard American Worker !!! Will plan to use your service in the future!"</p>
				
				<p style="text-align: right;"><strong>F. LeJeune</strong></p>
                
                
                
                <hr />
                 
                  <p>"I have been impressed with Best Name Badges for three reasons. One – they are responsive and professional. Two - ordering is simple. Three - when something strange happened with one of my orders, they fixed the problem quickly and to my absolute satisfaction. I strongly recommend them. "</p>
				
				<p style="text-align: right;"><strong>Steven Jones, PERCEPTION MARKETING</strong></p>
				
                
                
                 <hr />
                 
                  <p>"Edwin and I are working on getting name badges and/or name tags for my company. I am so impressed with his service, prompt replies and attention to my requests. I sure hope 10 stars is the highest, because my intention is that you understand the value you have in an employee like Edwin."</p>
				
				<p style="text-align: right;"><strong>Marjilette Brown</strong></p>
                
                 <hr />
                 
                  <p>"Alex was quick and professional. He responded and sent me my proof in a very short time, then assisted me with pricing."</p>
				
				<p style="text-align: right;"><strong>Cindy Anderson</strong></p>
                
                 <hr />
                 
                 <p>"I just wanted to say what a pleasure it was to work with your representative Mark. My order was very small, but Mark treated me like I had a valuable customer. We may be able to get new name tags for all of our volunteers before long and I will certainly choose Best Name Badges and I'll recommend you to anyone I know that needs your product. Thanks for having such a kind, considerate and knowledgeable employee. "</p>
				
				<p style="text-align: right;"><strong>Olivia McKeever</strong></p>
                
                 <hr />
				
				<p>"I had an extremely tight turnaround on my order, and I can't give enough praise for how wonderful Edwin's customer service has been. He has kept me updated and has given me quick responses each step of the way. I have been so impressed by both of your representatives I have had the pleasure of working with on orders and will continue to use your company largely in part to your great service along with the quality product. Thank you for a positive experience with your company!"</p>
				
				<p style="text-align: right;"><strong>G. Watkins, Warner Press</strong></p>
                
                 <hr />
				
				<p>"We got our nametags today – they look AMAZING! So professional.  Thank you so much!  Next time we order nametags, I know right where to go!"</p>
				
				<p style="text-align: right;"><strong>Daryl, Involved For Life, Inc.</strong></p>
                
                
                 <hr />
				
				<p>"The badges arrived this morning while I was out.  I just opened the box – they are Excellent.  THANK YOU again for all your assistance."</p>
				
				<p style="text-align: right;"><strong>R. Wuchert, The Valley Railroad Company</strong></p>
                
                <hr />
				
				<p>"Just received our name badges and I couldnt be more satisfied with them. Thank you so much. I will definitely send more business your way whenever I get the chance."</p>
				
				<p style="text-align: right;"><strong>JR. Ben's Family Restaurant</strong></p>
                
                
				<hr />
				
				<p>"Just wanted to say that Chris Hall really came through for me again! I needed a fast turnaround on some name tags. Not only did he help get them done, he got them here ahead of time as well....as a matter of fact, just a day or two later. I will be back just because of that service! thank you!"</p>
				
				<p style="text-align: right;"><strong>D. Dockery</strong></p>
				
				<hr />
				
				<p>"Our Name badges came today & I am very pleased with them.  Thank you!  Since they are so nice, I will be ordering a couple more for ancillary/part-time staff also!"</p>
				
				<p style="text-align: right;"><strong>D. Burnham, Creative Compounds</strong></p>
				
				<hr />
				
				<p>"I just wanted to tell you that the badges turned out perfectly!! Everyone is really happy with them."</p>
				
				<p style="text-align: right;"><strong>A. Adair, Houston Retina</strong></p>
				
				<hr />
				
				<p>"Got the badges in time yesterday and they look great. Thanks!"</p>
				
				<p style="text-align: right;"><strong>A. Cason, Futurex</strong></p>
				
				
				<hr />
				
				<p>"Thank you. You both are so efficient. Really impressed."</p>
				
				<p style="text-align: right;"><strong>M. Wertheim, GOTouchDown Travel</strong></p>
				
				<hr />
				
				<p>"Everyone really liked the badges."</p>
				
				<p style="text-align: right;"><strong>M. Brown, CIU</strong></p>
				
				<hr />
				
				<p>"They are perfect thanks so much!"</p>
				
				<p style="text-align: right;"><strong>A. Nakelski</strong></p>
				
				
				
				<hr />
				
				<p>"I got the badges today. They look GREAT!!. Thanks for helping me in such short notice. This will surprise the whole office. Once again thanks for the excellent service and fast shipping."</p>
				
				<p style="text-align: right;"><strong>T. Walker, Summit Tax & Accounting</strong></p>
				
				
				
				<hr />
				
				<p>"We received the badges- they look great!"</p>
				
				<p style="text-align: right;"><strong>K. Conklin, Gordon's Window Decor</strong></p>
				
				
				
				<hr />
				
				<p>"We received the orders and they look great! Thank you so much. We are really pleased with how they turned out."</p>
				
				<p style="text-align: right;"><strong>H. Muranaka, NextGen Academy</strong></p>
				
				
				
				<hr />
				
				<p>"The name badges turned out perfect, and our organization looks forward to using your services for future semesters."</p>
				
				<p style="text-align: right;"><strong>Ashley, CSCMP</strong></p>
				
				
				
				<hr />
				
				<p>"Thanks for being so responsive. Your customer service is exceptional. "</p>
				
				<p style="text-align: right;"><strong>J. Casey, University of Texas</strong></p>
				
				
				
				<hr />
				
				<p>"I just wanted to let you know that we got the Badges.  Loved them! Thank you so much for your time and work."</p>
				
				<p style="text-align: right;"><strong>C. Coll, SCORE Miami</strong></p>
				
				
				
				<hr />
				
				<p>"We have received the badges, and are delighted with them! Thank you!"</p>
				
				<p style="text-align: right;"><strong>Louise, Island Shipping & Trading Co.</strong></p>
				
				
				
				<hr />
				
				<p>"Our badges look great and the volunteers are thrilled!"</p>
				
				<p style="text-align: right;"><strong>A. Wade, Colerain Township</strong></p>
				
				
				
				<hr />
				
				<p>"We received our name badges today, and I must say they look great!! Thanks for all of your help!"</p>
				
				<p style="text-align: right;"><strong>M. Lane, TRUGREEN</strong></p>
				
				
				
				<hr />
				
				<p>"Also, just a quick compliment:  Your company wasn't the first one that I found during my Google searches and the other sites were so difficult to work with.  When I did come across Best Name Badges, I was able to complete my order in the time it took me to locate the badge style I wanted on other sites.  Your company was such a relief, thank you!"</p>
				
				<p style="text-align: right;"><strong>G. Isaacs, Certain Software, Inc.</strong></p>
				
				
				
				<hr />
				
				<p>"Great people and great company to work with."</p>
				
				<p style="text-align: right;"><strong>O. Ababiya, Alliance Francaise d'Atlanta</strong></p>
				
				
				
				<hr />
				
				<p>"I would like to thank Best Name Badges employee Chris for sending samples, and employees Alex and Michael for being patient when I changed my order multiple times, for calling me for clarification to ensure that the name badges were made the way I wanted them, and for the surprisingly fast delivery to my business location. The name badges look very nice. That was great customer service you guys."</p>
				
				<p style="text-align: right;"><strong>N. Militan, Capital OB/GYN</strong></p>
				
				
				
				<hr />
				
				<p>"Thank you!! I have been super happy with you guys by the way! Keep up the awesome work!"</p>
				
				<p style="text-align: right;"><strong>R. Driskell, Brazos Fellowship</strong></p>
				
				
				
				<hr />
				
				<p>"I just wanted to let you know that our badges were delivered today and we are very pleased with how they came out."</p>
				
				<p style="text-align: right;"><strong>C. Elliott, United Outstanding Physicians</strong></p>
				
				
				
				<hr />
				
				<p>"Just wanted to report that the name badges have already arrived!!! They look fabulous!! Everybody loves the quality of the product and can't believe how quickly you were able to do them for us. AMAZING!!"</p>
				
				<p style="text-align: right;"><strong>M. Roen, Arizon State University</strong></p>
				
				
				
				<hr />
				
				<p>"Thank you so much! You have been an enormous help with this. FIVE STARS for customer service!"</p>
				
				<p style="text-align: right;"><strong>T. Takahashi</strong></p>
				
				
				
				<hr />
				
				<p>"Just received the package with four badges included.  You've exceeded my expectations in all departments. Thank you so much; these will certainly help us to maintain a professional image."</p>
				
				<p style="text-align: right;"><strong>D. Elliott</strong></p>
				
				
				
				<hr />
				
				<p>"I got the name tags today, they look great.  Thank you for all the help, when I need more name badges I will be back. "</p>
				
				<p style="text-align: right;"><strong>Dr. J. Anderson, Robek Chiropractic</strong></p>
				
				
				
				<hr />
				
				<p>"I received the name badges early this afternoon.  All comments have been very positive and everyone is very impressed."</p>
				
				<p style="text-align: right;"><strong>R. Carrey, Sensor Technology Ltd.</strong></p>
				
				
				
				<hr />
				
				<p>"I received the badges today. They look great! Thanks for all your help and the speedy processing & shipping!"</p>
				
				<p style="text-align: right;"><strong>D. Hamilton, Swallow Hill Music Association</strong></p>
				
				
				
				<hr />
				
				<p>"The badges just arrived and we are exceptionally pleased. Thank you for your patience to get everything right and the best they could look.
				
				
				
				 <br /><br />
				
				Please thank everyone who assisted you at best name badges!!! Use us as a reference. You do it right. You are the BEST!"</p>
				
				<p style="text-align: right;"><strong>L. Flippen, UMEA</strong></p>
				
				
				
				<hr />
				
				<p>"I received the badges today. They look great! Thanks for all your help and the speedy processing & shipping!"</p>
				
				<p style="text-align: right;"><strong>Deidre, Swallow Hill Music Association</strong></p>
				
				
				
				<hr />
				
				<p>"Thank you so very much again for your excellent service!
				
				We appreciate all that you have done for us!
				
				"</p>
				
				<p style="text-align: right;"><strong>K. Grasso, Blue Mt Christian Retreat</strong></p>
				
				
				
				<hr />
				
				<p>"We LOVED them! Thanks so much!!!"</p>
				
				<p style="text-align: right;"><strong>G. Medina, YWCA</strong></p>
				
				
				
				<hr />
				
				<p>"Thanks Ryan, appreciate your prompt reply. Wish most of my vendors were more like you guys."</p>
				
				<p style="text-align: right;"><strong>T.J. Chen</strong></p>
				
				
				
				<hr />
				
				<p>"Received the badges and they are perfect! Thanks!"</p>
				
				<p style="text-align: right;"><strong>A. Knudsen, Kapenzo Hair</strong></p>
				
				
				
				<hr />
				
				<p>"Just wanted to THANK YOU very much for the name badges.  They are AWESOME."</p>
				
				<p style="text-align: right;"><strong>S. Ezard, OEP</strong></p>
				
				
				
				<hr />
				
				<p>"Thanks So much for over-nighting the badges! They look fantastic! Great Work :)"</p>
				
				<p style="text-align: right;"><strong>J. Howell</strong></p>
				
				
				
				<hr />
				
				<p>"I got my name badge today and it is fabulous!  Thank you so much."</p>
				
				<p style="text-align: right;"><strong>Jill, Impromptu Guru</strong></p>
				
				
				
				
				
				<hr />
				
				<p>"I got my name badge today and it's perfect. Thank you so much!"</p>
				
				<p style="text-align: right;"><strong>L. Gleeson</strong></p>
				
				
				
				<hr />
				
				<p>"The staff were thrilled with the badges - they are so classy looking and great quality."</p>
				
				<p style="text-align: right;"><strong>A. Jones, Tri-Cities Prep</strong></p>
				
				
				
				<hr />
				
				<p>"I received the name badges.  They're fantastic! Thank you so much!"</p>
				
				<p style="text-align: right;"><strong>K. McNoldy, AttendStar</strong></p>
				
				
				
				<hr />
				
				<p>"Hi Chris & Ryan,<br/>
				
				I just received the badges we ordered and they look AMAZING!!!!
				
				Thank you so much for giving us such a great deal and doing such a fabulous job on them! We'll be needing more in a couple of months and I will definitely be contacting you guys for it!
				
				Thank you so much again!!"</p>
				
				<p style="text-align: right;"><strong>J. Song, Pretend City</strong></p>
				
				
				
				
				
				
				
				<hr />
				
				<p>"My name tags arrived today.    Thank you for patiently working with us to get the names tags the way we wanted them.  We could not be happier with the result!"</p>
				
				<p style="text-align: right;"><strong>P. Coleman, U.S. Foodservice</strong></p>
				
				
				
				<hr />
				
				<p>"I wanted to let you know that we received the name tags earlier this week and they are perfect!  They really do look modern and professional just like you said they would.  I really want to thank you for making the process simple and especially for keeping it from turning into a consuming project.  It was one of the easiest projects I have done.  We will definitely keep your name for the future & pass it along when we can."</p>
				
				<p style="text-align: right;"><strong>Dana, Ortho-Tain Inc.</strong></p>
				
				
				
				<hr />
				
				<p>"Just wanted to let you know that I received the nametags. They look great."</p>
				
				<p style="text-align: right;"><strong>Cara, designgoop</strong></p>
				
				
				
				<hr />
				
				<p>"Thanks for the great job you did on our name badges!"</p>
				
				<p style="text-align: right;"><strong>Dan, Modesty Matters</strong></p>
				
				
				
				<hr />
				
				<p>"I wanted to let you know how wonderful the badges turned out and how much I appreciate how quickly you turned this order around for us. Everyone was so impressed!
				
				I never imagined I could find such a great vendor by accident! What a wonderful surprise your company turned out to be--thanks so much for the awesome customer service. You really saved me.
				
				
				
				I will definitely recommend your company again and again and I hope to work with you in the near future. "</p>
				
				<p style="text-align: right;"><strong>M. Moskowitz, Mack Brooks Exhibitions</strong></p>
				
				
				
				<hr />
				
				<p>"We got our name badges a week ago or so and they are perfect!. I would have no problem recommending you to anyone who would ask us where we got our badges.  
				
				
				
				We are a Nationwide Consulting Company so we are setting the example for businesses across the country plus Canada, so that is why it was so important that these be right!  
				
				
				
				Thanks again for all your help in seeing this order through for us.   You're the best company I spoke to and I contacted several!  You are fast, responsive, caring and delivered as promised. 
				
				
				
				And thank you for treating me/us like your #1 customer."</p>
				
				<p style="text-align: right;"><strong>C. Denton, McKenzie Management</strong></p>
				
				
				
				<hr />
				
				<p>"IMPRESSED!!! Just taking a few minutes to tell you how impressed we are with your business.  From the time we found you online...to the awesome online chat availability, to the order being shipped & received...to now our employees wearing their beautiful badges.....we have been VERY PLEASED and will definantly be using you again, as well as pass along your name to others.  We have 12 stores on the East Coast and I WILL make sure our Marketing Manager knows to call you if we need anything like this again.  I was very skeptical of online businesses and am very happy we went with your company.  Ryan has been an incredible help and it was because of him,  we continued talking to your company that day online and then placed the order.  The magnets are awesome and hold VERY TIGHT (without having the pins that put holes in you clothes) .....again IMPRESSED!!!!."</p>
				
				<p style="text-align: right;"><strong>P. May, Ride-Away Handicap Equipment</strong></p>
				
				
				
				<hr />
				
				<p>"IMPRESSED AGAIN! WOW AGAIN! Thank you so much for the replacement badge. I was so suprised to see that badge arrive today and again...I am very impressed with your business.  We have passed your infomation along to our corporate office and hopefully they will pass it on to our other 11 locations :)
				
				 <br /><br />
				
				You're the best!
				
				 <br /><br />
				
				THANKS AGAIN!"</p>
				
				<p style="text-align: right;"><strong>P. May, Ride-Away Handicap Equipment</strong></p>
				
				        
				
				        <hr />
				
				<p>"Thank you, the name badges arrived today and they look great."</p>
				
				<p style="text-align: right;"><strong>Mary, Sullivan and Company</strong></p>
				
				        
				
				                <hr />
				
				<p>"I wanted to let you know the name tags are AMAZING! I will be sending all of my name tag orders to you from now on. Great product, great service!"</p>
				
				<p style="text-align: right;"><strong>L. Zachery, Papered Wonders</strong></p>
				
				        
				
				        <hr />
				
				<p>"I just received the name badges yesterday and they are perfect!  Thanks so much for the great quality badges at a reasonable price.  Will definitely reorder from you."</p>
				
				<p style="text-align: right;"><strong>L. Jencks</strong></p>
				
				        
				
				<hr />
				
				<p>"I'm very impressed. I setup our logo for the first time and ordered 6 new badges about 24 hours ago. Somehow, you made them perfectly and got them from Florida to our office in California. Great job and thank you."</p>
				
				<p style="text-align: right;"><strong>D. Peterson, Watershape Consulting</strong></p>
				
				
				
				<hr />
				
				<p>"That is so kind of you! I truly appreciate your extra effort. This is a really nice group of people (all gardeners) so I know that will appreciate the special touch."</p>
				
				<p style="text-align: right;"><strong>S. Catron, Cherokee Garden Library</strong></p>
				
				        
				
				
				
				<hr />
				
				<p>"Got the name tags today. They look fabulous! Thanks so much for all your help! ... 4 days within me contacting you, I have in my hand beautifully designed name tags!"</p>
				
				<p style="text-align: right;"><strong>Tiffany Collins, Southern UroGyn</strong></p>   
				
				   
				
				<hr />
				
				<p>"Amazing turnaround on those.
				
				<br /><br />
				
				I'm sure that we will be doing more business with your company in the
				
				future.
				
				"</p>
				
				<p style="text-align: right;"><strong>M. Ott, INTERSPORT</strong></p> 
				
				  
				
				  <hr />
				
				<p>"We just received our name badges in the mail. I have to say... they are GREAT! Thank you so much for your help. I will definitely be getting in touch next time we need to order."</p>
				
				<p style="text-align: right;"><strong>C. Beaird, Harmon Construction</strong></p>   
				
				
				
				  <hr />
				
				<p>"Awesome, thank you for the wonderful service!"</p>
				
				<p style="text-align: right;"><strong>S. Dyck, Frontier Auto & Industrial Supply</strong></p>  
				
				
				
				    <hr />
				
				<p>"The badges turned out great.  We will definitely use your service again. Thank you."</p>
				
				<p style="text-align: right;"><strong>B. King, Company of Kings</strong></p>  
				
				
				
				    <hr />
				
				<p>"Thanks!  All who have ordered your name badges have been really impressed.  Thanks for all your help!"</p>
				
				<p style="text-align: right;"><strong>B. Highline, Wintrust Mortgage Corporation</strong></p> 
				
				
				
				    <hr />
				
				<p>"The name badges arrived.  They look great."</p>
				
				<p style="text-align: right;"><strong>Les, George's Marine & Sports</strong></p> 
				
				
				
				 <hr />
				
				<p>"I am very pleased with my badge and will be ordering more for the rest of the staff very soon."</p>
				
				<p style="text-align: right;"><strong>H. Darby RN, Hospice In His Hands</strong></p>   
				
				
				
				      </p>
		</div>
    </div><!-- end mainContent -->

  

  </div><!-- end content -->

</div><!-- end wrapper -->



<div style="display: none;"><img src="/images/sevenReasonsButtonMinus.png" /></div>



<?php include_once 'inc/footer.php' ; ?>