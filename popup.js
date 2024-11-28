document.addEventListener('DOMContentLoaded', function() {
    const closePopupButton = document.getElementById('closePopup');
    const okPopupButton = document.getElementById('okPopup');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const popup = document.getElementById('popup');

    // Popup will show initially
    popup.style.display = 'flex'; 

    // Close button click event - back to form
    closePopupButton.addEventListener('click', function() {
        console.log("Close button clicked");  // Debugging log
        window.location.href = "formCO.html"; // Replace with your form page URL
    });

    // Ok button click event - show loading, then redirect to home
    okPopupButton.addEventListener('click', function() {
        console.log("Ok button clicked");  // Debugging log

        // Show loading overlay
        loadingOverlay.style.display = 'flex';

        // Simulate processing (e.g., form submission, API call, etc.)
        setTimeout(function() {
            // Hide the loading overlay after the process is done
            loadingOverlay.style.display = 'none';

            // Redirect to home page after process completion
            window.location.href = "home.html"; // Replace with your home page URL
        }, 2000); // Simulate a 2-second delay
    });
});
