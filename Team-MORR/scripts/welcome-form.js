/*
    Filename: volunteer-form-JS.js
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
    10/30/2019
    JavaScript for volunteer-form.php
    Adds client-side validation for the welcome-form application.
*/

// Accessing all the document elements.
const fName = document.getElementById("first-name");
const lName = document.getElementById("last-name");
const phone = document.getElementById("phone");
const email = document.getElementById("email");
const dob = document.getElementById("date-of-birth");
const gradYear = document.getElementById("graduation-year");
const fNameErr = document.getElementById("fName-err");
const lNameErr = document.getElementById("lName-err");
const dobErr = document.getElementById("dob-err");
const genderErr = document.getElementById("gender-err");
const emailErr = document.getElementById("email-err");
const phoneErr = document.getElementById("phone-err");
const gradYearErr = document.getElementById("grad-year-err");
const otherGenderText = document.getElementById("other-gender");
const requiredInputValues = document.getElementsByClassName("text-danger err");
const gender = document.getElementById("gender");
const genderOptions = document.getElementsByClassName("gender-option");
const raceSelector = document.getElementById("race-selector");
const raceOptions = document.getElementsByClassName("race-option");
const otherRaceText = document.getElementById("other-race");
const gfName = document.getElementById("guardian-first-name");
const glName = document.getElementById("guardian-last-name");
const gRelation = document.getElementById("guardian-relation");
const gPhone = document.getElementById("g-phone");
const gEmail = document.getElementById("g-email");
const gfNameErr = document.getElementById("gfName-err");
const glNameErr = document.getElementById("glName-err");
const gRelationErr = document.getElementById("gRelation-err");
const gPhoneErr = document.getElementById("g-phone-err");
const gEmailErr = document.getElementById("g-email-err");

// from: https://www.regular-expressions.info/email.html
const emailRegex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
const phoneRegex = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

otherGenderText.style.display = "none";
otherRaceText.style.display = "none";

document.getElementById("welcome-form").onsubmit = validate;


//When user selects other for gender, new fields will prompt user for proper identity and appropriate pronouns
gender.onchange =  function() {
    if (genderOptions[gender.selectedIndex].value === "other") {
        otherGenderText.style.display = "block";
    } else {
        otherGenderText.style.display = "none";
    }
};

//When user selects other for race, then user can input correct race they identify as
raceSelector.onchange =  function() {
    if (raceOptions[raceSelector.selectedIndex].value === "7") {
        otherRaceText.style.display = "block";
    } else {
        otherRaceText.style.display = "none";
    }
};

/* Validation function ensures required fields are filled in with proper information */
function validate() {
    for(let i = 0; i < requiredInputValues.length; i++) {
        requiredInputValues[i].style.display = "none";
    }

    let isValid = true;

    if(fName.value === "") {
        fNameErr.style.display = "block";
        isValid = false;
    }
    if(lName.value === "") {
        lNameErr.style.display = "block";
        isValid = false;
    }
    if(phone.value === "" || !phoneRegex.test(phone.value)) {
        phoneErr.style.display = "block";
        isValid = false;
    }
    if(email.value === "" || !emailRegex.test(email.value)) {
        emailErr.style.display = "block";
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
    if(gfName.value === "") {
        gfNameErr.style.display = "block";
        isValid = false;
    }
    if(glName.value === "") {
        glNameErr.style.display = "block";
        isValid = false;
    }
    if(gPhone.value === "" || !phoneRegex.test(phone.value)) {
        gPhoneErr.style.display = "block";
        isValid = false;
    }
    if(gEmail.value === "" || !emailRegex.test(email.value)) {
        gEmailErr.style.display = "block";
        isValid = false;
    }
    if(gRelation.value === "") {
        gRelationErr.style.display = "block";
        isValid = false;
    }
    return isValid;
}
