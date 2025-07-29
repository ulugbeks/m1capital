// Add this script to your contact blade template
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success messages after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.style.display = 'none';
            }, 500);
        }, 5000);
    });
    
    // Add loading state to submit button
    const form = document.querySelector('.contact__form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function() {
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span>Sending...</span>
            <div class="_i_bg"></div>
            <i class="fas fa-spinner fa-spin"></i>
        `;
    });
});