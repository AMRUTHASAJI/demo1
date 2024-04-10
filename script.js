function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var phoneNumber = document.getElementById("phoneNumber").value;

    //check if the passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    //check if the phone number is 10-digit long and starts with a nonzero digit
    if (phoneNumber.length !== 10 || phoneNumber.startsWith('0')) {
        alert("Please enter a valid 10-digit phone number that does not start with zero.");
        return false;
    }

    return true;
}