document.getElementById("welcome-form").onsubmit = validate;
const requiredInputErrs = document.getElementsByClassName("required-inputErr");
const gender = $("#gender");
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
}}