/*
    Filename: send-email.js
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
    11/26/2019
    JavaScript for send-email.php
    Adds client-side validation for the sending out admin emails
*/

const subject = document.getElementById("subject");
const message = document.getElementById("message");
const send = document.getElementById("send");
const requiredInputValues = document.getElementsByClassName("required-input");

// add validate() to form submission.
document.getElementById("send-email").onsubmit = validate;

//clears all error notifications on loading of the page
for (let i = 0; i < requiredInputErrs.length; i++)
{
    requiredInputErrs[i].style.visibility = "hidden";
}

function validate() {
    let isValid = true;
    // search all required inputs
    for (let i = 0; i < requiredInputValues.length; i++)
    {
        // if input is empty, display error for the input
        if (requiredInputValues[i].value === "")
        {
            requiredInputValues[i].classList.add("border-danger");
            requiredInputErrs[i].style.visibility = "visible";
            isValid = false;
        }
        // all inputs good, clear error message
        else
        {
            requiredInputValues[i].classList.remove("border-danger");
            requiredInputErrs[i].style.visibility = "hidden";
        }
    }
    return isValid;
}
