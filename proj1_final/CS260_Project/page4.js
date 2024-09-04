var patentCounter = 4; // Start counter from 4, as you already have 3 rows in your HTML

document.addEventListener("DOMContentLoaded", function () {
    var addButton = document.getElementById("add_more_patent");
    if (addButton) {
        addButton.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var newRowHtml = `
          <tr height="60px" id="patent_row${patentCounter}">
            <td class="col-md-1">${patentCounter}</td>
            <td class="col-md-1">
              <input id="pauthor${patentCounter}" name="pauthor[]" type="text" placeholder="Author(s)" class="form-control input-md" required="">
            </td>
            <td class="col-md-1">
              <input id="ptitle${patentCounter}" name="ptitle[]" type="text" placeholder="Title" class="form-control input-md" required="">
            </td>
            <td class="col-md-1">
              <input id="p_country${patentCounter}" name="p_country[]" type="text" placeholder="Country" class="form-control input-md" required="">
            </td>
            <td class="col-md-1">
              <input id="p_number${patentCounter}" name="p_number[]" type="text" placeholder="Patent Number" class="form-control input-md" required="">
            </td>
            <td class="col-md-1">
              <input id="pyear_filed${patentCounter}" name="pyear_filed[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">
            </td>
            <td class="col-md-1">
              <input id="pyear_published${patentCounter}" name="pyear_published[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">
            </td>
            <td class="col-md-1">
              <input id="pyear_issued${patentCounter}" name="pyear_issued[]" type="text" placeholder="DD/MM/YYYY" class="form-control input-md" required="">
            </td>
            <td>
              <button class="btn btn-danger btn-sm" onclick="removePatentRow(${patentCounter})">Remove</button>
            </td>
          </tr>`;

            var tbody = document.getElementById("patent");
            if (tbody) {
                tbody.insertAdjacentHTML("beforeend", newRowHtml);
                patentCounter++;
            }
        });
    }
});

function removePatentRow(rowNumber) {
    var row = document.getElementById("patent_row" + rowNumber);
    if (row) {
        row.parentNode.removeChild(row);
    }
}
var bookCounter = 4; // Start counter from 4, as you already have 3 rows in your HTML

document.addEventListener("DOMContentLoaded", function () {
    var addButton = document.getElementById("add_more_book");
    if (addButton) {
        addButton.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var newRowHtml = `
          <tr height="60px" id="book_row${bookCounter}">
            <td class="col-md-1">${bookCounter}</td>
            <td class="col-md-4">
              <input id="bauthor${bookCounter}" name="bauthor[]" type="text" placeholder="Author" class="form-control input-md" required="">
            </td>
            <td class="col-md-3">
              <input id="btitle${bookCounter}" name="btitle[]" type="text" placeholder="Title" class="form-control input-md" required="">
            </td>
            <td class="col-md-2">
              <input id="byear${bookCounter}" name="byear[]" type="text" placeholder="Year of" class="form-control input-md" required="">
            </td>
            <td class="col-md-2">
              <input id="bisbn${bookCounter}" name="bisbn[]" type="text" placeholder="ISBN" class="form-control input-md" required="">
            </td>
            <td>
              <button class="btn btn-danger btn-sm" onclick="removeBookRow(${bookCounter})">Remove</button>
            </td>
          </tr>`;

            var tbody = document.getElementById("book");
            if (tbody) {
                tbody.insertAdjacentHTML("beforeend", newRowHtml);
                bookCounter++;
            }
        });
    }
});

function removeBookRow(rowNumber) {
    var row = document.getElementById("book_row" + rowNumber);
    if (row) {
        row.parentNode.removeChild(row);
    }
}
var bookChapterCounter = 4; // Start counter from 4, as you already have 3 rows in your HTML

document.addEventListener("DOMContentLoaded", function () {
    var addButton = document.getElementById("add_more_book_chapter");
    if (addButton) {
        addButton.addEventListener("click", function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var newRowHtml = `
          <tr height="60px" id="book_chapter_row${bookChapterCounter}">
            <td class="col-md-1">${bookChapterCounter}</td>
            <td class="col-md-4">
              <input id="bc_author${bookChapterCounter}" name="bc_author[]" type="text" placeholder="Author" class="form-control input-md" required="">
            </td>
            <td class="col-md-3">
              <input id="bc_title${bookChapterCounter}" name="bc_title[]" type="text" placeholder="Title" class="form-control input-md" required="">
            </td>
            <td class="col-md-2">
              <input id="bc_year${bookChapterCounter}" name="bc_year[]" type="text" placeholder="Year of" class="form-control input-md" required="">
            </td>
            <td class="col-md-2">
              <input id="bc_isbn${bookChapterCounter}" name="bc_isbn[]" type="text" placeholder="ISBN" class="form-control input-md" required="">
            </td>
            <td>
              <button class="btn btn-danger btn-sm" onclick="removeBookChapterRow(${bookChapterCounter})">Remove</button>
            </td>
          </tr>`;

            var tbody = document.getElementById("book_chapter");
            if (tbody) {
                tbody.insertAdjacentHTML("beforeend", newRowHtml);
                bookChapterCounter++;
            }
        });
    }
});

function removeBookChapterRow(rowNumber) {
    var row = document.getElementById("book_chapter_row" + rowNumber);
    if (row) {
        row.parentNode.removeChild(row);
    }
}


// Function to validate the form
function validateForm() {

    // Check if the logout button is clicked
    if ($('#logout').length) {
        // Logout button is clicked, no need for validation
        return true;
    }
    // Get references to form inputs
    var summary_journal_inter = document.getElementById('summary_journal_inter');
    var summary_journal = document.getElementById('summary_journal');
    var summary_conf_inter = document.getElementById('summary_conf_inter');
    var summary_conf_national = document.getElementById('summary_conf_national');
    var patent_publish = document.getElementById('patent_publish');
    var summary_book = document.getElementById('summary_book');
    var summary_book_chapter = document.getElementById('summary_book_chapter');
    var google_link = document.getElementById('google_link');

    // Perform validation
    if (summary_journal_inter.value === '' || isNaN(summary_journal_inter.value)) {
        alert('Please enter a valid number for Number of International Journal Papers');
        return false;
    }
    if (summary_journal.value === '' || isNaN(summary_journal.value)) {
        alert('Please enter a valid number for Number of National Journal Papers');
        return false;
    }
    if (summary_conf_inter.value === '' || isNaN(summary_conf_inter.value)) {
        alert('Please enter a valid number for Number of International Conference Papers');
        return false;
    }
    if (summary_conf_national.value === '' || isNaN(summary_conf_national.value)) {
        alert('Please enter a valid number for Number of National Conference Papers');
        return false;
    }
    if (patent_publish.value === '' || isNaN(patent_publish.value)) {
        alert('Please enter a valid number for Number of Patent(s)');
        return false;
    }
    if (summary_book.value === '' || isNaN(summary_book.value)) {
        alert('Please enter a valid number for Number of Book(s)');
        return false;
    }
    if (summary_book_chapter.value === '' || isNaN(summary_book_chapter.value)) {
        alert('Please enter a valid number for Number of Book Chapter(s)');
        return false;
    }
    if (google_link.value === '') {
        alert('Please enter your Google Scholar Link');
        return false;
    }

    // Form is valid
    return true;
}

// Attach the validation function to the form's submit event
document.getElementById('myForm').onsubmit = function() {
    return validateForm();
};

// Add form submission event listener
document.getElementById('submit').addEventListener('click', function(event) {
    // Validate form before submission
    if (!validateForm()) {
        // If form is not valid, prevent default form submission
        event.preventDefault();
        return false;
    }
});

// Add click event listener to the logout button
document.getElementById('logout').addEventListener('click', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();
    
    // Perform logout process here
    // For example, redirect the user to the logout page
    window.location.href = 'logout.php';
});
