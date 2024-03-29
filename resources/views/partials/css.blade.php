<link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@700&display=swap" rel="stylesheet">
<style>
/* Global styles */
body {
    background-color: rgb(150, 142, 131);
    color: #1a1a1a;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 0;
    margin: 0;
}

.container {
    width: 100%; /* Full width */
    max-width: 1500px; /* Max width to ensure content doesn't stretch too far on larger screens */
    margin: 0 auto; /* Center the container */
    padding: 0 20px; /* Padding on the sides for some breathing room */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

h2 {
    font-family: 'Tangerine', cursive; /* Ensures use of Tangerine font */
    color: #f9d857;
    background-color: #1a1a1a;
    padding: 10px 15px;
    margin: 0px 0 10px 0; /* Adjusted to control width and alignment */
    border-left: 2px solid #E5BE01;
    box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    font-size: 2em; /* Large size for emphasis */
    width: calc(100% - 40px); /* Adjust width to match the menu's width */
    letter-spacing: 0.05em;
}

.header {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Align to the left */
    position: relative; /* Establishes a positioning context for z-index */
}
@media (max-width: 768px) {
    .header {
        position: static; /* Change from relative to static if positioning causes overlap */
        z-index: auto; /* Resetting z-index to default if it interferes with element layering */
        justify-content: center; /* Optionally center the content on mobile */
    }
}


.logo {
    width: 150px; /* Set the logo width */
    height: auto; /* Maintain aspect ratio */
    z-index: 2; /* Ensures the logo overlaps the menu */
    position: relative; /* Required for z-index to take effect */
}

.title-and-nav {
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: absolute; /* Position the title and nav in relation to their parent */
    left: 140px; /* Adjust this value as needed to place the title and nav partially behind the logo */
    top: 0;
    z-index: 1; /* Ensures that the title and nav are under the logo */
}

.site-title {
    font-family: 'Tangerine', cursive; /* Ensures use of Tangerine font */
    color: #f9d857; /* Primary gold color */
    font-size: 4em; /* Large size for emphasis */
    letter-spacing: 2px; /* Adds a bit of spacing between characters */
    margin-left: 30px; /* Adjusts alignment */
    text-shadow: 
        1px 1px 0 #000, /* Even darker shade for more contrast */
        2px 2px 0 #000, /* Increases depth with darker shadows */
        3px 3px 0 #000,
        4px 4px 0 #000,
        0 0 5px #E5BE01, /* Soft glow around the text */
        0 0 15px #000, /* Added blurred black shadow for depth */
        0 0 25px rgba(0, 0, 0, 0.5); /* Further black shadow with reduced opacity for a softer edge */
    margin-bottom: 0; /* Adjusts spacing below the title */
}

.site-title a {
    color: #f9d857; /* Keeps the original color */
    text-decoration: none; /* Removes underline */
    font-family: 'Tangerine', cursive; /* Maintains the font */
    font-size: inherit; /* Inherits the font size from .site-title */
    letter-spacing: inherit; /* Inherits the letter spacing from .site-title */
    text-shadow: inherit; /* Inherits the text shadow from .site-title */
}



/* Updated Menu Styles */
nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    list-style-type: none;
    background-color: #131313;
    overflow: hidden;
    border-bottom: 2px solid #E5BE01;
    border-top: 0px solid #E5BE01;
}

nav ul li {
    margin: 0 5px;
    display: inline;
    margin-right: 10px;
}

nav ul li a {
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
    color: #ffc888;
    padding: 10px 15px;
    display: inline-block;
}

nav ul li a:hover, nav ul li a:focus {
    color: #f42f36;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-color: #444;
}


/* Navigation styles */
nav {
    display: inline-block;
}





/* Status Section adjustments */
.status-section {
    background-color: #1a1a1a;
    border-radius: 8px;
    margin-bottom: 30px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    color: #f8f8f8;
}

.status-title {
    font-size: 18px;
    font-weight: bold;
    color: #E5BE01;
    padding-bottom: 10px;
    margin-top: 0;
    text-transform: uppercase;
}

/* Form adjustments for left alignment */
.status-section form {
    display: block;
    grid-template-columns: auto 1fr auto; /* Adjust for label, select, and button */
    align-items: center;
    gap: 10px; /* Spacing between form elements */
}

.status-section select, .status-section button {
    padding: 8px;
    background-color: #333; /* Darker background for contrast */
    color: #E5BE01; /* Text color to match the theme */
    border: 1px solid #444; /* Subtle border */
    border-radius: 4px; /* Rounded corners */
}

.status-section button {
    background-color: #444; /* Slightly lighter than select for distinction */
    cursor: pointer;
    transition: background-color 0.3s;
}

.status-section button:hover {
    background-color: #555; /* Lighten on hover */
}

/* Light Status Section adjustments */
.light-status-section {
    background-color: #f8f8f8; /* Lighter background */
    border-radius: 8px;
    margin-bottom: 30px;
    padding: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Lighter shadow for a softer effect */
    color: #1a1a1a; /* Dark text for readability */
}

.light-status-title {
    font-size: 18px;
    font-weight: bold;
    color: #4a4a4a; /* Darker color for text */
    padding-bottom: 10px;
    margin-top: 0;
    text-transform: uppercase;
}

/* Form adjustments for left alignment in light theme */
.light-status-section form {
    display: block;
    grid-template-columns: auto 1fr auto; /* Adjust for label, select, and button */
    align-items: center;
    gap: 10px; /* Spacing between form elements */
}

.light-status-section select, .light-status-section button {
    padding: 8px;
    background-color: #eee; /* Lighter background for elements */
    color: #333; /* Dark text for contrast */
    border: 1px solid #ccc; /* Lighter border */
    border-radius: 4px; /* Rounded corners */
}

.light-status-section button {
    background-color: #ddd; /* Slightly darker than select for distinction */
    cursor: pointer;
    transition: background-color 0.3s;
}

.light-status-section button:hover {
    background-color: #ccc; /* Darken on hover */
}


/* Table styles */
table {
    border-collapse: separate;
    border-spacing: 0 2px;
    width: 100%;
    background-color: #E5BE01;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #444;
    border-right: 1px solid #444;
    vertical-align: top;
}

td {
    color: #000000;
}

th {
    color: #ffffff;
    background-color: #444;
}

th:first-child, td:first-child {
    border-left: 1px solid #444;
}

tr {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e0e0e0;
}



img.package-image {
    width: 100px;
    height: auto;
}

/* Adjustments for the bulkNewStatusID dropdown width */
.status-section select[name="bulkNewStatusID"] {
    width: auto; /* Allows the dropdown to adjust to its content width */
    padding: 8px;
    background-color: #333;
    color: #E5BE01;
    border: 1px solid #444;
    border-radius: 4px;
    /* For browsers that support it, this will make sure the select is not wider than its longest option */
    width: fit-content;
    width: -moz-fit-content; /* For Firefox */
}

/* Rounded corners for images */
img.package-image {
    width: 100px;
    height: auto;
    border-radius: 5px; /* Bringing back rounded corners */
}

/* Edit link color change */
a[href*="/packages/edit/"] {
    color: #333333; /* Gold color for better visibility */
    text-decoration: none; /* Optional: Removes underline */
}

a[href*="package_edit.php"]:hover {
    text-decoration: underline; /* Optional: Adds underline on hover */
}




/* Scoped Form Styling */
.custom-form-container form {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    max-width: 600px;
    margin: 20px auto;
}

.custom-form-container form label {
    display: block;
    margin-bottom: .5em;
    color: #333333;
    font-weight: bold;
}

.custom-form-container form input[type="text"],
.custom-form-container form input[type="number"],
.custom-form-container form input[type="file"],
.custom-form-container form textarea,
.custom-form-container form select {
    width: 100%;
    padding: 8px;
    margin-bottom: 1em;
    border: 1px solid #cccccc;
    border-radius: 4px;
    box-sizing: border-box; /* Ensures padding doesn't add to the width */
}

.custom-form-container form textarea {
    height: 100px;
}

.custom-form-container form input[type="submit"] {
    background-color: #E5BE01;
    color: #ffffff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.custom-form-container form input[type="submit"]:hover {
    background-color: #d4a904;
}

.custom-form-container button[type="submit"] {
    background-color: #E5BE01;
    color: #ffffff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.custom-form-container form button[type="submit"]:hover {
    background-color: #d4a904;
}


/* Hiding <br> elements inside form */
.custom-form-container form br {
    display: none;
}

.custom-form-container .form-control {
    width: 100%; /* Ensures full width within the container */
    padding: 0.375rem 0.75rem; /* Standard padding */
    font-size: 1rem; /* Standard font size */
    line-height: 1.5; /* Standard line height */
    color: #495057; /* Text color */
    background-color: #fff; /* Background color */
    border: 1px solid #ced4da; /* Border color */
    border-radius: 0.25rem; /* Border radius for rounded corners */
    box-sizing: border-box; /* Ensures padding does not affect overall width */
}


.status-section .form-label, .custom-form-container .form-label {
    color: #E5BE01; /* Lighter color for visibility */
    font-weight: bold;
}







li.active a {
    color: #f42f36; /* Color for the active link */
}


.account-login-prompt {
    text-align: center; /* Center the text inside the div */
    margin: 20px 0; /* Add some margin above and below */
    padding: 15px 10px; /* Padding inside the div */
    background-color: #f42f36; /* A bold color to draw attention, adjust as needed */
    color: #ffffff; /* White text for contrast */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* A subtle shadow for depth */
    font-weight: bold; /* Make the text bold */
}

.account-login-prompt p {
    margin: 0; /* Remove default paragraph margins for a cleaner look */
    font-size: 1.2em; /* Slightly larger text */
}
/* Targeting links within paragraphs inside .account-login-prompt */
.account-login-prompt p a {
    color: #ffffff; /* Match text color of the surrounding paragraph */
    text-decoration: none; /* Removes underline */
}

/* Optionally, add hover effects for the link */
.account-login-prompt p a:hover, .account-login-prompt p a:focus {
    color: #000000; /* Lighter shade for contrast, adjust as needed */
}




.site-footer {
    text-align: center;
    padding: 20px 10px;
    background-color: #1a1a1a;
    color: #E5BE01;
    margin-top: 30px; /* Ensure there's some space between the content and the footer */
    border-top: 2px solid #E5BE01; /* A top border that matches your theme */
}

.footer-content p {
    margin: 5px 0; /* Reduce space between lines if needed */
    font-size: 0.9em; /* Smaller font size for footer content */
}

@media (max-width: 768px) {
    .footer-content p {
        font-size: 0.8em; /* Even smaller font size for mobile to ensure it fits well */
    }
}
.footer-content a {
    color: #E5BE01; /* Match the link color to the footer font color */
    text-decoration: none; /* Optional: Removes underline from links */
}

.footer-content a:hover,
.footer-content a:focus {
    color: #d4c307; /* Slightly different color on hover/focus for accessibility */
    text-decoration: underline; /* Optional: Adds underline to links on hover/focus */
}


.beta-announcement {
    color: #000; /* Gold color to stand out on the background */
    text-align: center;
    padding: 0px 0;
    font-size: 15px; /* Larger font size for visibility */

}
.beta-announcement a {
    color: #000; /* Black color for the link text */
    text-decoration: underline; /* Underline to highlight it's a link */
    text-shadow: 1px 1px 0 #E5BE01; /* Text shadow for consistency */
}



.container-home {
    max-width: 1500px; /* Adjust the maximum width as needed */
    margin: auto; /* Center the container */
    padding: 0 15px 30px; /* Adds padding on the sides and 30px padding at the bottom */
}


.features-section {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.feature {
    flex: 1;
    min-width: 250px; /* Minimum width for each feature */
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Adds a subtle shadow for depth */
}

.feature h3 {
    margin-top: 0; /* Removes the default margin top for a cleaner look */
}

.testimonials-section {
    margin-top: 40px;
}

.testimonial {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Adds a subtle shadow for depth */
}

.testimonial p {
    font-style: italic; /* Optional: Italicize the testimonial text for emphasis */
}

.testimonial cite {
    display: block; /* Ensures the citation is on a new line */
    margin-top: 10px; /* Adds space above the citation */
    text-align: right; /* Aligns the citation to the right */
}

.cta-section {
    background-color: #1a1a1a;
    color: #E5BE01;
    text-align: center;
    padding: 40px 20px;
    margin-top: 40px;
    border-radius: 8px; /* Optional: Rounds the corners of the CTA section */
}

.cta-section h2, .cta-section p {
    color: #E5BE01; /* Ensures text within this section matches the specified color */
}

.btn-primary {
    background-color: #007bff; /* Primary button background color */
    color: #ffffff; /* Primary button text color */
    text-decoration: none; /* Removes underline from links styled as buttons */
    padding: 10px 20px; /* Padding inside the button */
    border-radius: 5px; /* Rounded corners for the button */
    display: inline-block; /* Allows padding and other box model properties */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.btn-primary:hover {
    background-color: #0056b3; /* Darker shade on hover */
}




/* Base styles */
.status-section {
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: auto;
    max-width: 100%; /* or your preferred max width */
}

.content-wrap {
    display: flex;
    flex-wrap: wrap; /* Ensures content can wrap */
    justify-content: center; /* Center content for single column layout on smaller screens */
    gap: 20px; /* Optional: adds space between items when they stack */
}

.text-content, .image-content {
    flex: 1 1 50%; /* Flex-basis set to 50% to attempt a 2-column layout */
    padding: 10px;
}

.image-content img {
    width: 100%; /* Full width of the container */
    height: auto; /* Maintain aspect ratio */
}









/* Adjust layout for mobile devices */
@media screen and (max-width: 768px) {
    .content-wrap {
        flex-direction: column; /* Stack vertically on smaller screens */
    }

    .text-content, .image-content {
        flex-basis: 100%; /* Each item takes full width of the container */
    }
}
@media (min-width: 769px) {
    /*
    this makes a mess on the computer
    .status-section {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
    }
    */

    .status-section .text-content, .status-section .image-content {
        width: 50%;
    }

    .status-section .image-content img {
        max-width: 100%;
        height: auto;
    }
}

@media (max-width: 768px) {
    .status-section {
        display: block;
    }

    .status-section .text-content, .status-section .image-content {
        width: 100%;
    }
}

/* Base styles */
.status-section {
    background-color: #1a1a1a;
    color: #f8f8f8;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    margin-bottom: 30px;
    border-radius: 8px;
}

.content-wrap {
    display: flex;
    flex-direction: row; /* Align items horizontally */
    justify-content: space-between; /* Space between text and image */
    align-items: flex-start; /* Align items at the start of the flex container */
}

.text-content {
    flex: 1; /* Take up as much space as available */
    margin-right: 20px; /* Add some space between the text and the image */
}

.image-content {
    flex: 1; /* Allows the container to grow and shrink but has a base size */
    max-width: 100%; /* Sets a maximum width for the image container, thus controlling the image size */
    margin: auto; /* Centers the container */
    text-align: center; /* Centers the image inside the container */
}

.image-content img {
    width: 100%; /* Image will scale with its container */
    height: auto; /* Maintains aspect ratio */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .content-wrap {
        flex-direction: column; /* Stack items vertically on smaller screens */
    }

    .text-content, .image-content {
        flex-basis: auto; /* Reset basis to auto for stacked layout */
        margin-right: 0; /* Remove the margin between text and image */
    }
}


/* Top Bar Styles */
/* Fixed Top Bar Styles */
.top-bar {
    display: flex; /* Hide the top bar by default */
    justify-content: space-between;
    align-items: center;
    padding: 10px 10px 0;
    background-color: #131313; /* Adjust the background color as needed */
    color: #ffffff;
    position: fixed; /* Make the top bar fixed at the top */
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000; /* Ensure it stays on top of other content */
}

/* Padding for the body to prevent content from being hidden behind the fixed top bar */
body {
    padding-top: 100px; /* Adjust based on the height of your top bar */
}

@media screen and (min-width: 768px) {
    .top-bar {
        display: none; /* Hide the top bar on computers */
    }
    body {
        padding-top: 10px; /* Adjust based on the height of your top bar */
    }

    /* Adjust other styles as needed for computers */
}


.site-name {
    font-family: 'Tangerine', cursive; /* Ensures use of Tangerine font */
    color: #f9d857; /* Primary gold color */
    font-size: 50px;
    font-weight: bold;
    text-align: center;
    flex-grow: 1;
}

.site-name a {
    color: #f9d857; /* Primary gold color for the link */
    text-decoration: none; /* Removes underline from the link */
    font-size: inherit; /* Inherits the font size from .site-name */
    font-weight: inherit; /* Inherits the font weight from .site-name */
    font-family: inherit; /* Ensures the font family is inherited from .site-name */
}

.top-bar-logo img {
    height: 80px; /* Logo height, adjust as needed */
}


@media (max-width: 768px) {
    .hamburger-menu {
        display: block;
    }

    nav ul {
        display: none;
        position: absolute;
        right: 0;
        top: 50px;
        width: 100%;
        background-color: #131313; /* Adjust the background to fit your design */
    }

    nav ul li {
        display: block;
        text-align: center;
    }

    nav ul.active {
        display: block;
    }
}

.hamburger-menu {
    display: none;
    background: none;
    font-size: 35px;
    border: none;
    color: #ffffff; /* Adjust the color to fit your design */
    cursor: pointer;
}


@media (max-width: 768px) {
    .hamburger-menu {
        display: block;
    }
}

@media (max-width: 768px) {
    .logo {
        display: none;
    }
    .site-title{
        visibility: hidden;
    }
    .hide-on-mobile {
        display: none;
  }
  .parcel-td-mobile {
    font-size: 8px; /* Adjust as needed */
  }
}



.table-container {
  overflow-x: auto;
  width: 100%;
}

table {
  width: 100%;
  /* Additional styling for the table */
}

/* CSS for desktop */
@media only screen and (min-width: 768px) {
  .flex-container {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
  }
}



@media (max-width: 768px) {
    .hamburger-menu {
        display: block;
    }

    nav ul {
        display: none; /* Hide by default */
        position: fixed; /* Fixed position to make it stick to the viewport */
        top: 90px; /* Start from the top edge of the viewport */
        left: 0; /* Start from the left edge of the viewport */
        background-color: #2C2C2C; /* Background color */
        z-index: 999; /* Ensure it's on top of other content */
        flex-direction: column; /* Stack items vertically */
        justify-content: start; /* Align items to the start */
        align-items: center; /* Center items horizontally */
        overflow-y: auto; /* Enable scrolling for overflow content */
    }

    nav ul li {
        display: block; /* Stack the links vertically */
        text-align: center; /* Center-align the text */
        font-size: 20px;
    }

    nav ul.active {
        display: flex; /* Use flexbox to display the menu */
    }
}


.button-edit {
    background-color: rgb(229, 190, 1); /* Primary button background color */
    color: #ffffff; /* Primary button text color */
    text-decoration: none; /* Removes underline from links styled as buttons */
    padding: 10px 20px; /* Padding inside the button */
    border-radius: 5px; /* Rounded corners for the button */
    display: inline-block; /* Allows padding and other box model properties */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

.button-edit:hover {
    background-color: RGB(178, 147, 0); /* Darker shade on hover */
}



</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('.hamburger-menu');
    const menu = document.querySelector('nav ul');

    menuButton.addEventListener('click', function() {
        menu.classList.toggle('active');
    });
});
</script>

