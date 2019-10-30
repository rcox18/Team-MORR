/*
    Filename: volunteer-form-JS.js
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
    10/30/2019
    JavaScript for volunteer-form.html
    Adds client-side validation for the welcome-form application.
*/

document.getElementById("welcome-form").onsubmit = validate;
const requiredInputErrs = document.getElementsByClassName("required-inputErr");
const gender = document.getElementById("gender");
const btnSubmit = document.getElementById("submit");

for (let i = 0; i < requiredInputErrs.length; i++)
{
    requiredInputErrs[i].style.visibility = "hidden";
}

gender.addEventListener("change", function() {
    if (gender.value == "other") {
        $("#other-gender").toggle();
    }
});

function validate() {
    let isValid = true;

    let requiredInputValues = document.getElementsByClassName("required-input");

    for (let i = 0; i < requiredInputValues.length; i++) {

        if (requiredInputValues[i].value === "") {
            requiredInputValues[i].classList.add("border-danger");
            requiredInputErrs[i].style.visibility = "visible";
            isValid = false;
        } else {
            requiredInputValues[i].classList.remove("border-danger");
            requiredInputErrs[i].style.visibility = "hidden";
        }
    }

    return isValid;
}