/*
    Filename: volunteer-form-JS.js
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
    10/30/2019
    JavaScript for volunteer-form.html
    Adds client-side validation for the welcome-form application.
*/

document.getElementById("welcome-form").onsubmit = validate;
const fName = document.getElementById("firstName");
const lName = document.getElementById("lastName");
const phone = document.getElementById("phone");
const email = document.getElementById("email");
const dob = document.getElementById("dob");
const race = document.getElementById("race-dropdown");
const otherRace = document.getElementById("other-race-div");
const raceErr = document.getElementById("race-err");
const gradYear = document.getElementById("graduation-year");
const fNameErr = document.getElementById("fName-err");
const lNameErr = document.getElementById("lName-err");
const dobErr = document.getElementById("dob-err");
const gender = document.getElementById("gender");
const genderErr = document.getElementById("gender-err");
const emailErr = document.getElementById("email-err");
const phoneErr = document.getElementById("phone-err");
const gradYearErr = document.getElementById("gradYear-err");


const emailRegex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
const phoneRegex = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

const btnSubmit = document.getElementById("submit");


gender.addEventListener("change", function() {
    if (gender.value === "other") {
        document.getElementById("other-gender").style.display = "block";
    } else {
        document.getElementById("other-gender").style.display = "none";
    }
    });

race.addEventListener("change", function() {
    if (race.value ==== "other") {
        otherRace.style.display = "block";
    } else {
        otherRace.style.display = "none";
    }
    });


function validate() {
    let isValid = true;

    var requiredInputValues = document.getElementsByClassName("text-danger err");
    for(i = 0; i < requiredInputValues.length; i++) {
        requiredInputValues[i].style.display = "none";
    }

    if(fName.value === "") {
        fNameErr.style.display = "block";
        isValid = false;
    }
    if(lName.value === "") {
        lNameErr.style.display = "block";
        isValid = false;
    }
    if(phone.value === "" || !phoneRegex.test(phone.value)) {
        phoneErr.style.display = "block"
        isValid = false;
    }
    if(email.value === "" || !emailRegex.test(email.value)) {
        emailErr.style.display = "block"
        isValid = false;
    }
    if(dob.value === "") {
        dobErr.style.display = "block";
        isValid = false;
    }
    if(gradYear.value === "none") {
        gradYearErr.style.display = "block";
        isValid = false;
    }
    if(gender.value === "none") {
        genderErr.style.display = "block";
        isValid = false;
    }
    if(race.value === "none") {
        raceErr.style.display = "block";
       isValid = false;
    }

    return isValid;
}