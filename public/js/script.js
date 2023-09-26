document.addEventListener("DOMContentLoaded", function () {
    const submissionForm = document.getElementById("submissionForm");
    submissionForm.addEventListener("submit", function (e) {
       
        e.preventDefault();
        if (!validateForm()) {
            return;
        }
        
        
        const formData = new FormData(submissionForm);
       // console.log(formData);
        fetch("/arraytics2/public/index.php?action=submit", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
               // console.log(data);
                if (data=='success') {
                    alert("Submission successful!");
                    submissionForm.reset();
                } else {
                   
                    alert("Submission failed. Please try again.");
                }
            })
            .catch((error) => {
                alert("An error occurred while submitting the form / Please try after 24 hours from previous submission");
                
            });
    });

    function validateForm() {
        var isAmountValid = validateAmount();
        var isBuyerValid = validateBuyer();
        var isReceiptIdValid = validateReceiptId();
        var isItemsValid = validateItems();
        var isBuyerEmailValid = validateBuyerEmail();
        var isNoteValid = validateNote();
        var isCityValid = validateCity();
        var isPhoneValid = validatePhone();
        var isEntryByValid = validateEntryBy();
        var isFormValid =
                        isAmountValid &&
                        isBuyerValid &&
                        isReceiptIdValid &&
                        isItemsValid &&
                        isBuyerEmailValid &&
                        isNoteValid &&
                        isCityValid &&
                        isPhoneValid &&
                        isEntryByValid;
        
        return isFormValid;
    }
    function validateAmount() {
        var amount = $("#amount").val();
        if (!/^\d+$/.test(amount)) {
            $("#amount-error").text("Amount must be a number.");
            return false;
        } 
        $("#amount-error").text("");
        return true;
    }

    
    function validateBuyer() {
        var buyer = $("#buyer").val();
        if (!/^[A-Za-z0-9\s]{1,20}$/.test(buyer)) {
            $("#buyer-error").text("Buyer must be alphanumeric and less than 20 characters.");
            return false;
        } 
        $("#buyer-error").text("");
        return true;
    }


    function validateReceiptId() {
        var receiptId = $("#receipt_id").val();
        if (!/^[A-Za-z]+$/.test(receiptId)) {
            $("#receipt_id-error").text("Receipt ID must be text only.");
            return false;
        } 
        $("#receipt_id-error").text("");
        return true;
    }

    
    function validateItems() {
        var items = $("#items").val();
        if (!/^[A-Za-z\s]+$/.test(items)) {
            $("#items-error").text("Items must be text only.");
            return false;
        } 
        $("#items-error").text("");
        return true;
    }

   
    function validateBuyerEmail() {
        var buyerEmail = $("#buyer_email").val();
        if (!/^\S+@\S+\.\S+$/.test(buyerEmail)) {
            $("#buyer_email-error").text("Invalid email address.");
            return false;
        }
        $("#buyer_email-error").text(""); 
        return true;
    }


    function validateNote() {
        var note = $("#note").val();
        if (note.length > 30) {
            $("#note-error").text("Note must not exceed 30 words.");
            return false;
        } 
        $("#note-error").text("");
        return true;
    }

    
    function validateCity() {
        var city = $("#city").val();
        if (!/^[A-Za-z\s]+$/.test(city)) {
            $("#city-error").text("City must be text and spaces only.");
            return false;
        }
        $("#city-error").text("");
        return true;
    }

    
    function validatePhone() {
        var phone = $("#phone").val();
        if (!/^\d+$/.test(phone)) {
            $("#phone-error").text("Phone must contain only numbers.");
            return false;
        }
        $("#phone-error").text("");
        return true;
    }

    
    function validateEntryBy() {
        var entryBy = $("#entry_by").val();
        if (!/^\d+$/.test(entryBy)) {
            $("#entry_by-error").text("Entry By must contain only numbers.");
            return false;
        }
        $("#entry_by-error").text("");
        return true;
    }
});

