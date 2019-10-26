document.getElementById("sign-up").onsubmit = validate;
const requiredInputErrs = document.getElementsByClassName("required-inputErr");
const shirtSize = document.getElementById("shirtSize");
const shirtSizeErr = document.getElementById("tshirtErr");
const hearAboutUsOptions = document.getElementById("hearUs").childNodes;
const otherAboutTextArea = document.getElementById("other-about-us");
const interestOptions = document.getElementsByName("interests[]");
const otherInterestsTextArea = document.getElementById("other-interests-text");
const agreeToPolicySwitch = document.getElementById("switch1");
const agreeToPolicyErr = document.getElementById("err-agree");
const btnSubmit = document.getElementById("submit");

for (let i = 0; i < requiredInputErrs.length; i++)
{
    requiredInputErrs[i].style.visibility = "hidden";
}
shirtSizeErr.style.visibility = "hidden";
otherAboutTextArea.style.display = "none";
otherInterestsTextArea.style.display  = "none";
btnSubmit.disabled = true;

for (let i = 0; i < hearAboutUsOptions.length; i++)
{
    hearAboutUsOptions[i].addEventListener("click", function ()
    {
        if(hearAboutUsOptions[i].selected && hearAboutUsOptions[i].value === "other")
        {
            otherAboutTextArea.style.display = "block";
        }
        else
        {
            otherAboutTextArea.style.display = "none";
        }
    });
}

for (let i = 0; i < interestOptions.length; i++)
{
    interestOptions[i].addEventListener("click", function ()
    {
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

agreeToPolicySwitch.addEventListener("change", function() {
    if(!agreeToPolicySwitch.checked) {
        agreeToPolicyErr.style.display = "block";
        btnSubmit.disabled = true;

    } else {
        agreeToPolicyErr.style.display = "none";
        btnSubmit.disabled = false;
    }
});

function validate()
{
    let isValid = true;

    let requiredInputValues = document.getElementsByClassName("required-input");

    for (let i = 0; i < requiredInputValues.length; i++)
    {

        if (requiredInputValues[i].value === "")
        {
            requiredInputValues[i].classList.add("border-danger");
            requiredInputErrs[i].style.visibility = "visible";
            isValid = false;
        }
        else
        {
            requiredInputValues[i].classList.remove("border-danger");
            requiredInputErrs[i].style.visibility = "hidden";
        }
    }

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

    return isValid;
}