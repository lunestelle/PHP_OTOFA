function toggleForm(showId, hideId) {
  const showForm = document.getElementById(showId);
  const hideForm = document.getElementById(hideId);
  
  showForm.style.display = showForm.style.display === "none" || showForm.style.display === "" ? "block" : "none";
  hideForm.style.display = showForm.style.display === "block" ? "none" : "block";

  const step3form1 = document.getElementById('step3form1');
  const step3form2 = document.getElementById('step3form2');
  const step3btnform1 = document.getElementById('step3btnform1');
  const step3btnform2 = document.getElementById('step3btnform2');

  const step2form1 = document.getElementById('step2form1');
  const step2form2 = document.getElementById('step2form2');
  const step2btnform1 = document.getElementById('step2btnform1');
  const step2btnform2 = document.getElementById('step2btnform2');

  const step2form1assessmentText = document.getElementById('assessmentFeeText');
  const step2form2assessmentText = document.getElementById('assessmentFeeText2');
  const step3form1assessmentText = document.getElementById('assessmentFeeText3');
  const step3form2assessmentText = document.getElementById('assessmentFeeText4');

  if (step3form1.style.display !== "none") {
    step3btnform1.classList.add("collapsible-active-button");
    step3btnform2.classList.remove("collapsible-active-button");
    step3btnform2.classList.add("collapsible-inactive-button");
    step3form2assessmentText.style.display = "none";
    step3form1assessmentText.style.display = "block";
  } else if (step3form2.style.display !== "none") {
    step3btnform2.classList.add("collapsible-active-button");
    step3btnform1.classList.remove("collapsible-active-button");
    step3btnform1.classList.add("collapsible-inactive-button");
    step3form2assessmentText.style.display = "block";
    step3form1assessmentText.style.display = "none";
  }

  if (step2form1.style.display !== "none") {
    step2btnform1.classList.add("collapsible-active-button");
    step2btnform2.classList.remove("collapsible-active-button");
    step2btnform2.classList.add("collapsible-inactive-button");
    step2form2assessmentText.style.display = "none";
    step2form1assessmentText.style.display = "block";
  } else if (step2form2.style.display !== "none") {
    step2btnform2.classList.add("collapsible-active-button");
    step2btnform1.classList.remove("collapsible-active-button");
    step2btnform1.classList.add("collapsible-inactive-button");
    step2form2assessmentText.style.display = "block";
    step2form1assessmentText.style.display = "none";
  }
}

window.onload = function() {
  const step3form1 = document.getElementById('step3form1');
  const step3form2 = document.getElementById('step3form2');
  const step3btnform1 = document.getElementById('step3btnform1');
  const step3btnform2 = document.getElementById('step3btnform2');
  
  step3form1.style.display = "block";
  step3form2.style.display = "none";
  step3btnform1.classList.add("collapsible-active-button");
  step3btnform2.classList.add("collapsible-inactive-button");

  const step2form1 = document.getElementById('step2form1');
  const step2form2 = document.getElementById('step2form2');
  const step2btnform1 = document.getElementById('step2btnform1');
  const step2btnform2 = document.getElementById('step2btnform2');
  
  step2form1.style.display = "block";
  step2form2.style.display = "none";
  step2btnform1.classList.add("collapsible-active-button");
  step2btnform2.classList.add("collapsible-inactive-button");
};  