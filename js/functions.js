// This function is making the needed data checks 
// for the input data of a user
// trying to register
function checkData() {
    let name = document.forms["register-form"]["name"].value;
    let address = document.forms["register-form"]["address"].value;
    let municipality = document.forms["register-form"]["municipality"].value;
    let prefecture = document.forms["register-form"]["prefecture"].value;
    let fuel = document.forms["register-form"]["fuel"].value;
    let vat = document.forms["register-form"]["vat"].value;
    let email = document.forms["register-form"]["email"].value;
    let password = document.forms["register-form"]["password"].value;
    let confirmPassword = document.forms["register-form"]["confirm-password"].value;
    
    // Some of the functions do nothing because of the "required" set property on html tags
    // Those functions are setted only because it was asked for from the university
    
    // Check company name
    if(name.length==0){
        alert('Εισάγετε επωνυμία της επιχείρησης.');
        return false;
    }

    // Check vat
    if (vat.length != 9) {
        window.alert('Το ΑΦΜ πρέπει να αποτελείται από 9 ψηφία.');
        return false;
    }

    // Check address
    if(address.length==0){
        alert('Εισάγετε διεύθυνση της επιχείρησης.');
        return false;
    }

    // Check prefecture
    if (prefecture === 'Επιλέξτε νομό' || prefecture === null) {
        window.alert('Επιλέξτε ένα νομό.');
        return false;
    }

    // Check municipality
    if (municipality === 'Επιλέξτε δήμο' || municipality === null) {
        window.alert('Επιλέξτε ένα δήμο.');
        return false;
    }

    // Check fuel
    if (fuel === 'Επιλέξτε είδος καυσίμου' || fuel === null) {
        window.alert('Επιλέξτε είδος καυσίμου.');
        return false;
    }

    // Check email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        window.alert("Λάθος μορφή email.");
        return false;
    }

    //Check password
    if (password != confirmPassword) {
        window.alert('Οι κωδικοί πρόσβασης πρέπει να είναι ίδιοι.');
        return false;
    } else {
        // Check password strength
        const passwordErrMsg = 'Ο κωδικός πρέπει να αποτελείται από τουλάχιστον 8 ψηφία, τουλάχιστον 1 αριθμό και τουλάχιστον 1 κεφαλαίο γράμμα.'
        const passwordRegex = /^(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]{8,}$/;
        if (!passwordRegex.test(password)) {
            window.alert(passwordErrMsg);
            return false;
        }
    }
}

// This function is making the needed checks for an offer that a user is trying to insert
function checkDataOffer() {
    let fuelType = document.forms["form-offer-registration"]["fuel"].value;
    let priceString = document.forms["form-offer-registration"]["price"].value;
    let date = document.getElementById("expiration-date").value;

    // Check fuel
    if (isFuelNull(fuelType)) {
        window.alert('Επιλέξτε είδος καυσίμου.');
        return false;
    }

    // Check price
    if (isPriceNull(priceString || isNaN(parseFloat(priceString)))) {
        window.alert('Εισάγετε τιμή προσφοράς.');
        return false;
    } else if (!checkPrice(priceString)) {
        window.alert('Λάθος εισαγωγή τιμής προσφοράς.');
        // Clear the wrong input from the view of user
        document.forms["form-offer-registration"]["price"].value = '';
        return false;
    }

    let price = parseFloat(priceString);
    price = price.toFixed(2);

    // Check date
    if (!isValidDate(date)) {
        window.alert('Εισάγετε ημερομηνία λήξης προσφοράς.');
        return false;
    } else if (isBeforeTodayDate(date)) {
        window.alert('Λάθος εισαγωγή ημερομηνίας λήξης προσφοράς.');
        // Clear the wrong input from the view of user
        document.forms["form-offer-registration"]["date"].value = new Date();
        return false;
    }
}

// Check the fuel function
function isFuelNull(fuelInput) {
    return (fuelInput === 'Επιλέξτε είδος καυσίμου' || fuelInput === '');
}

// Check the date function
function isValidDate(dateString) {
    // Parse the date string and check if it's valid
    let date = new Date(dateString);
    return !isNaN(date.getTime());
}

// Check if date is before today date
function isBeforeTodayDate(dateString) {
    let today = new Date().getTime();
    return new Date(dateString).getTime() < today;
}

// Check price functions
function isPriceNull(priceInput) {
    return priceInput === '' || priceInput === 'Εισάγετε τιμή';
}

function checkPrice(priceInput) {
    let priceRegex = /^(?:\d|[1-9]\d*|\d?\.\d+)$/;
    return priceRegex.test(priceInput);
}

function getCurrentDate() {
    date = new Date();
    year = date.getFullYear();
    month = date.getDate();
    day = date.getMonth() + 1;
    return document.getElementById("current-date").innerHTML = month + "/" + day + "/" + year;
}

// Function for the popup form
function popupWindow() {
    var newAnnouncementBtn = document.getElementById("new-announcement");
    var popup = document.getElementById("popup");
    var submitBtn = document.getElementById("submit-btn");
    var closeBtn = document.getElementById("close-btn");
    var popup = document.getElementById("popup");
   
    popup.style.display = "block";
    
    submitBtn.onclick = function() {
        var title = document.getElementById("title").value;
        var date = document.getElementById("date").value;
        var content = document.getElementById("content").value;
    }

    closeBtn.onclick = function() { 
        popup.style.display = "none";
    }
}

// Function for the delete confirmation
function deleteConfirmationWindow() {
    if (confirm("Όλα τα δεδομένα της συγκεκριμένης ανακοίνωσης θα διαγραφούν. Είστε σίγουροι;")) {
        return true;
    } else {
        return false;
    }
}

// Function for the validation of a new announcement entry
function checkNewAnnouncementData() {
    // There is no needed/asked for validation at this point
}

function downloadXML() {
    window.open('./xml/downloadXML.php');
}