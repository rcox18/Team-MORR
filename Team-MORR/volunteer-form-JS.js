document.getElementById("sign-up").onsubmit = validate;
const requiredInputErrs = document.getElementsByClassName("required-inputErr");
const shirtSize = document.getElementById("shirtSize");
const shirtSizeErr = document.getElementById("tshirtErr");

for (let i = 0; i < requiredInputErrs.length; i++)
{
    requiredInputErrs[i].style.visibility = "hidden";
}
shirtSizeErr.style.visibility = "hidden";

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