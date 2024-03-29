<!--
    Filename: volunteer-form.php
    By Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url http://team-morr.greenriverdev.com/pages/volunteer-form.html
	The HTML is used for team Morr's version of a volunteer sign-up form that could be
    potentially used for Brandi Day's website, non-profit organization iD.A.Y Dream

    testing branch commits 2
-->
<?php
include "../php/errors.php";
include "../php/header.php";
?>

    <title>iD.A.Y Dream Volunteer Form</title>
</head>
<body>
<!--Intro-->
<div class="container" id="main">
    <div class="jumbotron jumbotron-fluid fixed-top mb-3 pr-2">
        <img src="//static1.squarespace.com/static/5dabc823c0e45245a9c250cd/t/5dacd1ebfe152f3a7aa1de79/1572281708171/?format=1500w"
             alt="iD.A.Y. Dream" class="img-fluid img-thumbnail rounded float-left">
        <h1 class="display-4 font-weight-bold">Volunteer Form</h1>
        <p class="lead font-weight-bold">Thank you so much for your interest in ID.A.Y.Dream! Before you can volunteer with us,
            we just need to get a little bit of personal info. If you have any questions or concerns,
            please <a href="https://www.idaydream.org/contact-us">contact us</a>.</p>
    </div>
    <!--Start of the Form-->
    <form action="volunteer-confirmation-page.php" id="sign-up" method="post" name="volunteer-form">
        <!--Contact Info-->
        <fieldset class="form-group" id="contact">
            <legend>Personal Info</legend>
            <!--First Name-->
            <label for="firstName">First name<span class="text-danger required-inputErr">*required</span></label>
            <input type="text" class="form-control required-input" name="first-name" id="firstName">


            <!--Last Name-->
            <label for="lastName">Last name<span class="text-danger required-inputErr">*required</span></label>
            <input type="text" class="form-control required-input" name="last-name" id="lastName" >


            <!--Email-->
            <label for="email">Email address<span class="text-danger required-inputErr">*required</span></label>
            <input type="text" class="form-control required-input" name="email" id="email">
            <div class="row">
                <div class="col">
                    <p class="mb-0">Please add me to your mailing list.</p>
                    <div class="form-group form-check mt-0">
                        <label class="form-check-label" for="mail-list-yes">
                            <input class="form-check-input" type="radio" name="add-to-email" id="mail-list-yes" value="yes" checked>
                            Yes
                        </label>
                        <label class="form-check-label ml-5" for="mail-list-no">
                            <input class="form-check-input" type="radio" name="add-to-email" id="mail-list-no" value="no">
                            No, thank you.
                        </label>
                    </div>
                </div>
            </div>
            <!--Phone Number-->
            <label for="phone">Phone number<span class="text-danger required-inputErr">*required</span></label>
            <span class="err" id="err-phone">
                Please enter a phone number
            </span>
            <input type="text" class="form-control required-input" name="phone" id="phone">
        </fieldset>

        <!--New Section for more personal info such as address, city, and state-->
        <fieldset class="form-group" id="address">
            <!--Address-->
            <legend>Address Info</legend>
            <label for="street1">Street address<span class="text-danger required-inputErr">*required</span></label>
            <input type="text" class="form-control required-input" name="address-street" id="street1" >

            <!--Apartment or PO Box Number-->
            <label for="street2">Apt/PO Box#</label>
            <input type="text" class="form-control" name="apo-po-box" id="street2" >

            <!--City-->
            <label for="city">City<span class="text-danger required-inputErr">*required</span></label>
            <input type="text" class="form-control required-input" name="city" id="city" >

            <!--Select State with dropdown-->
            <label for="state">State</label>
            <select class="form-control" name="state" id="state">
                <option value="select">Select</option>
                <option value="AL">AL</option><option value="AK">AK</option><option value="AR">AR</option>
                <option value="AZ">AZ</option><option value="CA">CA</option><option value="CO">CO</option>
                <option value="CT">CT</option><option value="DC">DC</option><option value="DE">DE</option>
                <option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option>
                <option value="IA">IA</option><option value="ID">ID</option><option value="IL">IL</option>
                <option value="IN">IN</option><option value="KS">KS</option><option value="KY">KY</option>
                <option value="LA">LA</option><option value="MA">MA</option><option value="MD">MD</option>
                <option value="ME">ME</option><option value="MI">MI</option><option value="MN">MN</option>
                <option value="MO">MO</option><option value="MS">MS</option><option value="MT">MT</option>
                <option value="NC">NC</option><option value="NE">NE</option><option value="NH">NH</option>
                <option value="NJ">NJ</option><option value="NM">NM</option><option value="NV">NV</option>
                <option value="NY">NY</option><option value="ND">ND</option><option value="OH">OH</option>
                <option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option>
                <option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option>
                <option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option>
                <option value="VT">VT</option><option value="VA">VA</option><option value="WA" selected>WA</option>
                <option value="WI">WI</option><option value="WV">WV</option><option value="WY">WY</option>
            </select>

            <!--ZIP code-->
            <label for="zip">ZIP code<span class="text-danger required-inputErr">*required</span></label>
            <input type="text" class="form-control required-input" name="zip" id="zip">
        </fieldset>

        <!--Interests Section-->
        <fieldset class="form-group">
            <legend>Interests</legend>
            <!--Select which volunteer opportunities interest you-->
            <label>Tell us in which areas you are interested in volunteering</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Events" id="Events" name="interests[]">
                <label class="form-check-label" for="Events">
                    Events (Annual College Tour, Community Service, Annual New Year’s Eve Day Event)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Fundraising" id="Fundraising" name="interests[]">
                <label class="form-check-label" for="Fundraising">
                    Fundraising
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       value="Newsletter production" id="newsletterProduction" name="interests[]">
                <label class="form-check-label" for="newsletterProduction">
                    Newsletter production (monthly)
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox"
                       value="Volunteer coordination" id="volunteerCoordination" name="interests[]">
                <label class="form-check-label" for="volunteerCoordination">
                    Volunteer coordination
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Mentoring" id="Mentoring" name="interests[]">
                <label class="form-check-label" for="Mentoring">
                    Mentoring
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="other" id="other-interests" name="interests[]">
                <label class="form-check-label" for="other-interests">
                    Other
                </label>
            </div>
            <div id="other-interests-textbox">
                <label for="other-interests-text">Please specify</label>
                <textarea class="form-control mt-2" name="other-interests-text" id="other-interests-text" rows="5"></textarea>
            </div>
        </fieldset>

        <!--How did you hear about us drop down-->
        <fieldset class="form-group">
            <legend>How did you hear about us</legend>
            <div class="form-group">
                <label for="hear-about-us-selector">Please Select One</label>
                <select class="form-control" name="hear-about-us" id="hear-about-us-selector">
                    <option class="hear-option" value="none">Select from the following</option>
                    <option class="hear-option" value="word">Word of mouth / Friend / Colleague</option>
                    <option class="hear-option" value="media">Web / Social Media (Facebook, Twitter, Google, iD.A.Y.dream website)</option>
                    <option class="hear-option" value="print">Print (flyer, poster, brochure)</option>
                    <option class="hear-option" value="sponsor">Corporate sponsor</option>
                    <option class="hear-option" value="other">Other</option>
                </select>
                <div id="other-about-us" >
                    <label class="mt-2" for="other-about-us-text">Please specify</label>
                    <textarea class="form-control " name="other-about-us" id="other-about-us-text" rows="5"></textarea>
                </div>
            </div>
        </fieldset>

        <!--T Shirt size-->
        <fieldset class="form-group">
            <legend>What is your t-shirt size<span class="text-danger" id="tshirtErr"> *required</span></legend>
            <div class="form-group">
                <label for="shirtSize"></label>
                <select class="form-control" name="tshirt-size" id="shirtSize">
                    <option value="none">Select a t-shirt size (adult)</option>
                    <option value="xsmall">Extra Small</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    <option value="xlarge">Extra Large</option>
                    <option value="1x">1X</option>
                    <option value="2x">2X</option>
                </select>
            </div>
        </fieldset>

        <!--Experience and Availability-->
        <fieldset class="form-group">
            <div id="exp-available">
                <!--Text box to enter volunteer roles that interest you-->
                <label for="roles">Please detail volunteer roles that interest you! We want to ensure we utilize your skills!</label>
                <textarea class="form-control" name="roles" id="roles" rows="5" form="sign-up"></textarea>

                <!--Text box to enter previous experience that relates to iD.A.Y Dream-->
                <label for="prev-experience">Do you have any previous volunteer experience with other youth serving organizations?</label>
                <textarea class="form-control" name="prev-experience" id="prev-experience" rows="5" form="sign-up"></textarea>

                <!--Text box to enter other applicable experience-->
                <label for="applicable-exp">Any other applicable experience you would like to mention?</label>
                <textarea class="form-control" name="applicable-exp" id="applicable-exp" rows="5" form="sign-up"></textarea>

                <!--Text box to enter motivation for volunteering-->
                <label for="motivation">What motivated you to volunteer with us?<span class="text-danger required-inputErr">*required</span></label>
                <textarea class="form-control required-input" name="motivation" id="motivation" rows="5" form="sign-up"></textarea>

                <!--Checkbox list for volunteering availability-->

                <label>Please select the choices that most fit your volunteer availability:</label><br>
                <input type="checkbox" form="sign-up" id="weekdays" value="weekdays" name="availability[]">
                <label for="weekdays" class="form-check-label">
                    Weekdays
                </label><br>
                <div id="weekday-options" class="day-options" >
                    <input type="checkbox" form="sign-up" id="monday" value="monday" name="availability[]">
                    <label for="monday" class="form-check-label">Monday</label><br>
                    <div id="mon-times" class ="time-options">
                        <input type="checkbox" id="mon-morn" value="mon-morn" name="availability[]">
                        <label for="mon-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="mon-aft" value="mon-aft" name="availability[]">
                        <label for="mon-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="mon-eve" value="mon-eve" name="availability[]">
                        <label for="mon-eve" class="form-check-label">Evening</label><br>
                    </div>
                    <input type="checkbox" form="sign-up" id="tuesday" value="tuesday" name="availability[]">
                    <label for="tuesday" class="form-check-label">Tuesday</label><br>
                    <div id="tues-times" class ="time-options">
                        <input type="checkbox" id="tues-morn" value="tues-morn" name="availability[]">
                        <label for="tues-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="tues-aft" value="tues-aft" name="availability[]">
                        <label for="tues-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="tues-eve" value="tues-eve" name="availability[]">
                        <label for="tues-eve" class="form-check-label">Evening</label><br>
                    </div>
                    <input type="checkbox" form="sign-up" id="wednesday" value="wednesday" name="availability[]">
                    <label for="wednesday" class="form-check-label">Wednesday</label><br>
                    <div id="wed-times" class ="time-options">
                        <input type="checkbox" id="wed-morn" value="wed-morn" name="availability[]">
                        <label for="wed-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="wed-aft" value="wed-aft" name="availability[]">
                        <label for="wed-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="wed-eve" value="wed-eve" name="availability[]">
                        <label for="wed-eve" class="form-check-label">Evening</label><br>
                    </div>
                    <input type="checkbox" form="sign-up" id="thursday" value="thursday" name="availability[]">
                    <label for="thursday" class="form-check-label">Thursday</label><br>
                    <div id="thurs-times" class ="time-options">
                        <input type="checkbox" id="thurs-morn" value="thurs-morn" name="availability[]">
                        <label for="thurs-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="thurs-aft" value="thurs-aft" name="availability[]">
                        <label for="thurs-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="thurs-eve" value="thurs-eve" name="availability[]">
                        <label for="thurs-eve" class="form-check-label">Evening</label><br>
                    </div>
                    <input type="checkbox" form="sign-up" id="friday" value="friday" name="availability[]">
                    <label for="friday" class="form-check-label">Friday</label>
                    <div id="fri-times" class ="time-options">
                        <input type="checkbox" id="fri-morn" value="fri-morn" name="availability[]">
                        <label for="fri-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="fri-aft" value="fri-aft" name="availability[]">
                        <label for="fri-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="fri-eve" value="fri-eve" name="availability[]">
                        <label for="fri-eve" class="form-check-label">Evening</label><br>
                    </div>
                </div>
                <input type="checkbox" form="sign-up" id="weekends" value="weekends" name="availability[]">
                <label for="weekends" class="form-check-label">
                    Weekends
                </label><br>
                <div id="weekend-options" class="day-options">
                    <input type="checkbox" form="sign-up" id="saturday" value="saturday" name="availability[]">
                    <label for="saturday" class="form-check-label">Saturday</label><br>
                    <div id="sat-times" class ="time-options">
                        <input type="checkbox" id="sat-morn" value="sat-morn" name="availability[]">
                        <label for="sat-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="sat-aft" value="sat-aft" name="availability[]">
                        <label for="sat-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="sat-eve" value="sat-eve" name="availability[]">
                        <label for="sat-eve" class="form-check-label">Evening</label><br>
                    </div>
                    <input type="checkbox" form="sign-up" id="sunday" value="sunday" name="availability[]">
                    <label for="sunday" class="form-check-label">Sunday</label><br>
                    <div id="sun-times" class="time-options">
                        <input type="checkbox" id="sun-morn" value="sun-morn" name="availability[]">
                        <label for="sun-morn" class="form-check-label">Morning</label><br>
                        <input type="checkbox" id="sun-aft" value="sun-aft" name="availability[]">
                        <label for="sun-aft" class="form-check-label">Afternoon</label><br>
                        <input type="checkbox" id="sun-eve" value="sun-eve" name="availability[]">
                        <label for="sun-eve" class="form-check-label">Evening</label><br>
                    </div>
                </div>
                <input type="checkbox" form="sign-up" id="camp" value="summer-camp" name="availability[]">
                <label for="camp" class="form-check-label">
                    Summer Camp
                </label><br>
                <div id="summer-text" class="day-options">
                    <label for="summer-avail" class="form-check-label">List any major time conflicts (vacations, other camps, etc.) that would
                        prevent you from volunteering during a certain time periods in the summer</label>
                    <textarea id="summer-avail" name="summer-conflicts"></textarea>
                </div>
            </div>
        </fieldset>
        <!--Character References-->
        <fieldset class="form-group" id="references-form">
            <legend>Character References</legend>
            <fieldset class="form-group innerFieldset">
                <legend>Reference 1</legend>
                <div class="form-row">
                    <div class="col">
                        <label for="firstRef">Name<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref1-name" id="firstRef">
                    </div>
                    <div class="col">
                        <label for="firstRefRel">Relationship<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref1-relation" id="firstRefRel">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="firstRefPhone">Phone<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref1-phone" id="firstRefPhone">
                    </div>
                    <div class="col">
                        <label for="firstRefEmail">Email<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref1-email" id="firstRefEmail">
                    </div>
                </div>
            </fieldset>
            <fieldset class="form-group innerFieldset">
                <legend>Reference 2</legend>
                <div class="form-row">
                    <div class="col">
                        <label for="secondRef">Name<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref2-name" id="secondRef">
                    </div>
                    <div class="col">
                        <label for="secondRefRel">Relationship<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref2-relation" id="secondRefRel">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="secondRefPhone">Phone<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref2-phone" id="secondRefPhone">
                    </div>
                    <div class="col">
                        <label for="secondRefEmail">Email<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref2-email" id="secondRefEmail">
                    </div>
                </div>
            </fieldset>

            <fieldset class="form-group innerFieldset">
                <legend>Reference 3</legend>
                <div class="form-row">
                    <div class="col">
                        <label for="thirdRef">Name<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref3-name" id="thirdRef">
                    </div>
                    <div class="col">
                        <label for="thirdRefRel">Relationship<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref3-relation" id="thirdRefRel">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="thirdRefPhone">Phone<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref3-phone" id="thirdRefPhone">
                    </div>
                    <div class="col">
                        <label for="thirdRefEmail">Email<span class="text-danger required-inputErr">*required</span></label>
                        <input type="text" class="form-control required-input" name="ref3-email" id="thirdRefEmail">
                    </div>
                </div>
            </fieldset>
        </fieldset>

        <!--Policy Section-->
        <fieldset class="form-group" id="policy-form">
            <legend>Our Policy</legend>
            <p>It is the policy of this organization to provide equal opportunities without regard to race, color, religion, national origin, gender, sexual preference, age, or disability</p>
            <p>Thank you for completing this application form and for your information in volunteering with us.</p>
        </fieldset>

        <!--Agreement Section-->
        <fieldset class="form-group" id="signature-form">
            <legend >Agreement</legend>
            <p>By submitting this application, I certify that my statements in this application are true, complete and correct to the best of my knowledge. I further understand that as a part of the volunteer verification and matching process, additional personal information will be required of me. I hereby authorize iD.A.Y.dream to contact the references listed and to conduct a background check to determine if I will be a good fit as a volunteer for the organization. I understand that submitting this application does not guarantee my participation. I also hereby authorize iD.A.Y.dream without limitation, to copy, publish, exhibit or distribute photographs or video tapes of my volunteer activities for the purpose of promoting volunteerism and support. I release and hold harmless from liability any person or organization that provides information. I also agree to hold harmless iD.A.Y.dream and the officers and volunteers thereof.</p>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="switch1" name="agreement-switch">
                <label class="custom-control-label" for="switch1">I have read and agree to the statement above.</label>
            </div>
            <span class="err" id="err-agree">Because of our values as an organization and out of the safety of the youth
            we serve it is a requirement that a background check must be submitted.
            You have chosen to decline. Thank you for your consideration in volunteering
            with iD.A.Y. dream, at this time we are unable to move forward with your submission.
            Please visit us again!</span>
        </fieldset>
        <br>
        <!--Submit button-->
        <div class="row ">
            <div class="col text-center">
                <button id="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<?php
include "../php/footer.php";
?>
<script src="../scripts/volunteer-form-JS.js"></script>
</body>
</html>