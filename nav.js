// for loading navigation bar + fixed cache issue
function loadNavbar() {
  fetch("navbar.php", { cache: "no-store" })
    .then(response => response.text())
    .then(data => {
      document.getElementById("navbar-container").innerHTML = data;
    })
    .catch(error => console.error("Error loading navbar:", error));
}

// search bar filters
function filterBookingList(input) {
  const query = input.value.toLowerCase();
  const tableRows = document.querySelectorAll(".base-table tbody tr");

  tableRows.forEach(row => {
    const bookingId = row.cells[0].textContent.toLowerCase();
    const guestID = row.cells[2].textContent.toLowerCase();

    if (bookingId.includes(query) || guestID.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

function filterHotelList(input) {
  const query = input.value.toLowerCase();
  const tableRows = document.querySelectorAll(".base-table tbody tr");

  tableRows.forEach(row => {
    const hotelID = row.cells[0].textContent.toLowerCase();
    const branchName = row.cells[1].textContent.toLowerCase();

    if (hotelID.includes(query) || branchName.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

function filterRoomTypeList(input) {
  const query = input.value.toLowerCase();
  const tableRows = document.querySelectorAll(".base-table tbody tr");

  tableRows.forEach(row => {
    const roomTypeId = row.cells[0].textContent.toLowerCase();
    const roomTypeName = row.cells[1].textContent.toLowerCase();

    if (roomTypeId.includes(query) || roomTypeName.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

function filterRoomList(input) {
  const query = input.value.toLowerCase();
  const tableRows = document.querySelectorAll(".base-table tbody tr");

  tableRows.forEach(row => {
    const hotelID = row.cells[0].textContent.toLowerCase();
    const roomId = row.cells[1].textContent.toLowerCase();
    const roomNumber = row.cells[3].textContent.toLowerCase();

    if (hotelID.includes(query) || roomId.includes(query) || roomNumber.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

function filterGuestList(input) {
  const query = input.value.toLowerCase();
  const tableRows = document.querySelectorAll(".base-table tbody tr");

  tableRows.forEach(row => {
    const bookingId = row.cells[0].textContent.toLowerCase();
    const name = row.cells[1].textContent.toLowerCase();

    if (bookingId.includes(query) || name.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}

// logic for double click edit functionality
document.addEventListener('DOMContentLoaded', function () {
  const rows = document.querySelectorAll('.base-table tbody tr');
  rows.forEach(function (row) {
    row.addEventListener('dblclick', function () {
      const editButton = row.querySelector("input[name='edit']");
      if (editButton) {
        editButton.click();
      }
    });
  });
});

// for displaying our error message
setTimeout(() => {
    document.querySelectorAll('.alert-box').forEach(el => {
        el.style.display = 'none';
    });
}, 10000); // closes the error message div after 10 seconds


// delete popup confirmation
// reference : https://developer.mozilla.org
document.addEventListener("DOMContentLoaded", function () {
  const popup = document.getElementById("deletePopup");
  if (!popup) return;

  const confirmBtn = popup.querySelector(".confirm-delete");
  const cancelBtn = popup.querySelector(".cancel-delete");

  let currentForm = null;

  // when user clicks the delete 
  document.querySelectorAll("input[name='delete']").forEach(btn => {
    btn.addEventListener("click", function () {
        currentForm = this.form;
        popup.style.display = "flex";
    });
  });


  // if user confirms delete
  confirmBtn.addEventListener("click", function () {
      if (currentForm) {
          const hiddenDelete = document.createElement("input");
          hiddenDelete.type = "hidden";
          hiddenDelete.name = "delete";
          hiddenDelete.value = "Delete";

          currentForm.appendChild(hiddenDelete);
          popup.style.display = "none";
          currentForm.submit();
      }
  });

  // if user cancels delete
  cancelBtn.addEventListener("click", function () {
      popup.style.display = "none";
      currentForm = null;
  });
});
