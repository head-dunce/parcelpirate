<link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@700&display=swap" rel="stylesheet">
<style>
/* Global styles */
body {
    background-color: rgb(150, 142, 131);
    color: #1a1a1a;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 20px;
    margin: 0;
}

h2 {
    color: #E5BE01;
    background-color: #1a1a1a;
    padding: 10px 15px;
    margin: 0px 0 10px 0; /* Adjusted to control width and alignment */
    border-left: 2px solid #E5BE01;
    box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    text-transform: uppercase;
    width: calc(100% - 40px); /* Adjust width to match the menu's width */
}

.header {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Align to the left */
    position: relative; /* Establishes a positioning context for z-index */
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
    color: #E5BE01; /* Primary gold color */
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
    border-bottom: 1px solid #444;
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
    display: grid;
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

/* Table styles */
table {
    border-collapse: separate;
    border-spacing: 0 5px;
    width: 100%;
    background-color: #333;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #444;
    border-right: 1px solid #444;
}

th {
    background-color: #444;
}

th:first-child, td:first-child {
    border-left: 1px solid #444;
}

tr:hover {
    background-color: #383838;
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
a[href*="package_edit.php"] {
    color: #E5BE01; /* Gold color for better visibility */
    text-decoration: none; /* Optional: Removes underline */
}

a[href*="package_edit.php"]:hover {
    text-decoration: underline; /* Optional: Adds underline on hover */
}
</style>

