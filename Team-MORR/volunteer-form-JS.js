document.getElementById("sign-up").onsubmit = validate;
const referenceInputErrs = document.getElementsByClassName("refErr");

for (let i = 0; i < referenceInputErrs.length; i++)
{
    referenceInputErrs[i].style.visibility = "hidden";
}

function validate()
{
    let isvalid = true;
    let referenceInputValues = document.getElementsByClassName("ref");


    for (let i = 0; i < referenceInputValues.length; i++)
    {

        if (referenceInputValues[i].value === "")
        {
            referenceInputValues[i].classList.add("border-danger");
            referenceInputErrs[i].style.visibility = "visible";
            isvalid = false;
        }
        else
        {
            referenceInputValues[i].classList.remove("border-danger");
            referenceInputErrs[i].style.visibility = "hidden";
        }
    }
    return isvalid;
}