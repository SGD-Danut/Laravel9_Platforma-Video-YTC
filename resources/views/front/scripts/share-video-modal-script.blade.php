<script>
    // Modal Code:
    // Get the modal
    let modal = document.getElementById("shareModal");
    
    // Get the button that opens the modal
    let btn = document.getElementById("shareModalBtn");
    
    // Get the <span> element that closes the modal
    let span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    //Copy to Clipboard Code:
    function copyToClipboardCode() {
      // Get the text field
      let copyText = document.getElementById("shareModalInput");
  
      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices
  
      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
  
      // Alert the copied text
      alert("Copied the text: " + copyText.value);
    }
  </script>