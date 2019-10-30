/*
    Filename: volunteer-form-JS.js
    By: Team MORR
	Marcos, Olivia, Raj, and Robert Cox
    10/30/2019
    JavaScript for volunteer-form.html
    Adds client-side validation for the volunteer application.
*/

// Accessing all the document elements.
const requiredInputErrs = document.getElementsByClassName("required-inputErr");
const shirtSize = document.getElementById("shirtSize");
const shirtSizeErr = document.getElementById("tshirtErr");
const hearAboutUsSelector = document.getElementById("hear-about-us-selector");
const hearAboutUsOptions = document.getElementsByClassName("hear-option");
const otherAboutTextArea = document.getElementById("other-about-us");
const interestOptions = document.getElementsByName("interests[]");
const otherInterestsTextArea = document.getElementById("other-interests-textbox");
const weekdays = document.getElementById("weekdays");
const weekends = document.getElementById("weekends");
const summer = document.getElementById("camp");
const mon = document.getElementById("monday");
const tues = document.getElementById("tuesday");
const wed = document.getElementById("wednesday");
const thurs = document.getElementById("thursday");
const fri = document.getElementById("friday");
const sat = document.getElementById("saturday");
const sun = document.getElementById("sunday");
const agreeToPolicySwitch = document.getElementById("switch1");
const agreeToPolicyErr = document.getElementById("err-agree");
const btnSubmit = document.getElementById("submit");
const requiredInputValues = document.getElementsByClassName("required-input");

// from: https://www.regular-expressions.info/email.html
const emailRegex = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i;
const phoneRegex = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
const zipRegex = /^\d{5}$/;

// add validate() to form submission.
document.getElementById("sign-up").onsubmit = validate;

//clears all error notifications on loading of the page
for (let i = 0; i < requiredInputErrs.length; i++)
{
    requiredInputErrs[i].style.visibility = "hidden";
}
shirtSizeErr.style.visibility = "hidden";
otherAboutTextArea.style.display = "none";
otherInterestsTextArea.style.display  = "none";
// resets agreement switch and submit button on page load
agreeToPolicySwitch.checked = false;
btnSubmit.disabled = true;

// listener for change to hear about us dropdown selector
hearAboutUsSelector.onchange = function ()
{
    // if selected option is other, display text area else hide text area
    if(hearAboutUsOptions[hearAboutUsSelector.selectedIndex].value === "other")
    {
        otherAboutTextArea.style.display = "block";
    }
    else
    {
        otherAboutTextArea.style.display = "none";
    }
};

// listener for interest options
for (let i = 0; i < interestOptions.length; i++)
{
    interestOptions[i].addEventListener("click", function ()
    {
        // if selected option is other, display text area else hide text area
        if(interestOptions[i].checked && interestOptions[i].value === "other")
        {
            otherInterestsTextArea.style.display = "block";
        }
        else if(!interestOptions[i].checked && interestOptions[i].value === "other")
        {
            otherInterestsTextArea.style.display = "none";
        }
    });
}

// listeners for availability option selected, toggles option list
weekdays.addEventListener("change", function() {
    $("#weekday-options").toggle();
});
weekends.addEventListener("change", function() {
    $("#weekend-options").toggle();
});
summer.addEventListener("change",function() {
    $("#summer-text").toggle()
});

mon.addEventListener("change",function() {
    $("#mon-times").toggle()
});
tues.addEventListener("change",function() {
    $("#tues-times").toggle()
});
wed.addEventListener("change",function() {
    $("#wed-times").toggle()
});
thurs.addEventListener("change",function() {
    $("#thurs-times").toggle()
});
fri.addEventListener("change",function() {
    $("#fri-times").toggle()
});
sat.addEventListener("change",function() {
    $("#sat-times").toggle()
});
sun.addEventListener("change",function() {
    $("#sun-times").toggle()
});

// agreement switch must be on else submit button is disabled
agreeToPolicySwitch.addEventListener("change", function() {
    if(!agreeToPolicySwitch.checked) {
        agreeToPolicyErr.style.display = "block";
        btnSubmit.disabled = true;

    } else {
        agreeToPolicyErr.style.display = "none";
        btnSubmit.disabled = false;
    }
});

// runs upon form submission to validate the inputs
function validate()
{
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
        // checks if input is email, phone or zip, then uses regular expression to validate each
        else if ((requiredInputValues[i].getAttribute("name").includes("email") &&
            !emailRegex.test(requiredInputValues[i].value)) ||
            (requiredInputValues[i].getAttribute("name").includes("phone") &&
                !phoneRegex.test(requiredInputValues[i].value)) ||
            (requiredInputValues[i].getAttribute("name").includes("zip") &&
                !zipRegex.test(requiredInputValues[i].value)))
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

    // must select t-shirt size
    if(shirtSize[shirtSize.selectedIndex].value === "none")
    {
        shirtSizeErr.style.visibility = "visible";
        shirtSize.classList.add("border-danger");
        isValid = false;
    }
    else
    {
        shirtSize.classList.remove("border-danger");
        shirtSizeErr.style.visibility = "hidden";
    }

    // returns true or false to indicate form is valid
    return isValid;
}