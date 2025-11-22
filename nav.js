function loadNavbar() {
  fetch("navbar.php", { cache: "no-store" })
    .then(response => response.text())
    .then(data => {
      document.getElementById("navbar-container").innerHTML = data;
    })
    .catch(error => console.error("Error loading navbar:", error));
}

// search bar filter
  
function filterBookingList(input) {
  const query = input.value.toLowerCase();
  const tableRows = document.querySelectorAll(".base-table tbody tr");

  tableRows.forEach(row => {
    const bookingId = row.cells[0].textContent.toLowerCase();
    const guestID = row.cells[1].textContent.toLowerCase();

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
    const roomId = row.cells[1].textContent.toLowerCase();
    const roomNumber = row.cells[3].textContent.toLowerCase();

    if (roomId.includes(query) || roomNumber.includes(query)) {
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