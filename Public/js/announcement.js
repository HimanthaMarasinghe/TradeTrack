// Handle the submit button click
document.getElementById("submit-btn").addEventListener("click", function() {
    // Get the selected user and announcement text
    const selectedUser = document.getElementById("user-select").value;
    const announcementText = document.getElementById("announcement-text").value.trim();
  
    // Check if the announcement text is empty
    if (announcementText === "") {
      alert("Please write an announcement before submitting.");
      return;
    }
  
    // Simulate sending the message to the selected user
    alert(`Announcement sent to ${selectedUser}:\n\n${announcementText}`);
  
    // Clear the text area after submission
    document.getElementById("announcement-text").value = "";
  });
  