document.addEventListener('DOMContentLoaded', () => {
    validimiLogIn();
    validimiSignUp();
});

function validimiLogIn() {
    const Submit1 = document.getElementById('submit1');

    const validate = (ngjarja) => {
        const emaili1 = document.getElementById('emaili1');
        const fjalkalimi1 = document.getElementById('pass1');

        if (emaili1.value.trim() === "") {
            alert("Ju lutem shtoni email-in.");
            emaili1.focus();
            ngjarja.preventDefault();
            return false;
        }

        if (!emailValid(emaili1.value)) {
            alert("Ju lutem shtoni një email valid.");
            emaili1.focus();
            ngjarja.preventDefault();
            return false;
        }

        if (fjalkalimi1.value.trim() === "") {
            alert("Ju lutem shtoni fjalëkalimin.");
            fjalkalimi1.focus();
            ngjarja.preventDefault();
            return false;
        }

        return true;
    };

    const emailValid = (email) => {
        const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
        return emailRegex.test(email.toLowerCase());
    };

    Submit1.addEventListener('click', (event) => validate(event));
}

function validimiSignUp() {
    const Submit2 = document.getElementById('submit2');

    const validate = (ngjarja) => {
        const emaili2 = document.getElementById('emaili2');
        const fjalkalimi2 = document.getElementById('pass2');
        const emrin1 = document.getElementById('emri1');
        const mbiemri1 = document.getElementById('mbiemri1');

        if (emrin1.value.trim() === "") {
            alert("Ju lutem shtoni emrin.");
            emrin1.focus();
            ngjarja.preventDefault();
            return false;
        }

        if (mbiemri1.value.trim() === "") {
            alert("Ju lutem shtoni mbiemrin.");
            mbiemri1.focus();
            ngjarja.preventDefault();
            return false;
        }

        if (emaili2.value.trim() === "") {
            alert("Ju lutem shtoni email-in.");
            emaili2.focus();
            ngjarja.preventDefault();
            return false;
        }

        if (!emailValid(emaili2.value)) {
            alert("Ju lutem shtoni një email valid.");
            emaili2.focus();
            ngjarja.preventDefault();
            return false;
        }

        if (fjalkalimi2.value.trim() === "") {
            alert("Ju lutem shtoni fjalëkalimin.");
            fjalkalimi2.focus();
            ngjarja.preventDefault();
            return false;
        }

        return true;
    };

    const emailValid = (email) => {
        const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
        return emailRegex.test(email.toLowerCase());
    };

    Submit2.addEventListener('click', (event) => validate(event));
}