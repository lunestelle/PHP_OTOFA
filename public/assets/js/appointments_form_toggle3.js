function toggleForm(showId, hideIds) {
  const showForm = document.getElementById(showId);
  const hideForms = hideIds.map(id => document.getElementById(id));

  showForm.style.display = showForm.style.display === "none" || showForm.style.display === "" ? "block" : "none";

  hideForms.forEach(form => {
    form.style.display = showForm.style.display === "block" ? "none" : "block";
  });

  const step3form1 = document.getElementById('step3form1');
  const step3btnform1 = document.getElementById('step3btnform1');
  const step3form1assessmentText = document.getElementById('assessmentFeeText4');

  const step3form2 = document.getElementById('step3form2');
  const step3btnform2 = document.getElementById('step3btnform2');
  const step3form2assessmentText = document.getElementById('assessmentFeeText5');

  const step3form3 = document.getElementById('step3form3');
  const step3btnform3 = document.getElementById('step3btnform3');
  const step3form3assessmentText = document.getElementById('assessmentFeeText6');

  if (step3form1 && step3form1.style.display !== "none") {
    step3btnform1.classList.add("collapsible-active-button");
    step3btnform2.classList.remove("collapsible-active-button");
    step3btnform2.classList.add("collapsible-inactive-button");
    step3btnform3.classList.remove("collapsible-active-button");
    step3btnform3.classList.add("collapsible-inactive-button");
    step3form2.style.display = "none";
    step3form3.style.display = "none";
    if (step3form1assessmentText && step3form2assessmentText && step3form3assessmentText) {
      step3form1assessmentText.style.display = "block";
      step3form2assessmentText.style.display = "none";
      step3form3assessmentText.style.display = "none";
    }
  } else if (step3form2 && step3form2.style.display !== "none") {
    step3btnform2.classList.add("collapsible-active-button");
    step3btnform1.classList.remove("collapsible-active-button");
    step3btnform1.classList.add("collapsible-inactive-button");
    step3btnform3.classList.remove("collapsible-active-button");
    step3btnform3.classList.add("collapsible-inactive-button");
    step3form1.style.display = "none";
    step3form3.style.display = "none";
    if (step3form2assessmentText && step3form1assessmentText && step3form3assessmentText) {
      step3form2assessmentText.style.display = "block";
      step3form1assessmentText.style.display = "none";
      step3form3assessmentText.style.display = "none";
    }
  } else if (step3form3 && step3form3.style.display !== "none") {
    step3btnform3.classList.add("collapsible-active-button");
    step3btnform1.classList.remove("collapsible-active-button");
    step3btnform1.classList.add("collapsible-inactive-button");
    step3btnform2.classList.remove("collapsible-active-button");
    step3btnform2.classList.add("collapsible-inactive-button");
    step3form1.style.display = "none";
    step3form2.style.display = "none";
    if (step3form3assessmentText && step3form1assessmentText && step3form2assessmentText) {
      step3form2assessmentText.style.display = "block";
      step3form1assessmentText.style.display = "none";
      step3form3assessmentText.style.display = "none";
    }
  }

  const step2form1 = document.getElementById('step2form1');
  const step2btnform1 = document.getElementById('step2btnform1');
  const step2form1assessmentText = document.getElementById('assessmentFeeText');

  const step2form2 = document.getElementById('step2form2');
  const step2btnform2 = document.getElementById('step2btnform2');
  const step2form2assessmentText = document.getElementById('assessmentFeeText2');

  const step2form3 = document.getElementById('step2form3');
  const step2btnform3 = document.getElementById('step2btnform3');
  const step2form3assessmentText = document.getElementById('assessmentFeeText3');

  if (step2form1 && step2form1.style.display !== "none") {
    step2btnform1.classList.add("collapsible-active-button");
    step2btnform2.classList.remove("collapsible-active-button");
    step2btnform2.classList.add("collapsible-inactive-button");
    step2btnform3.classList.remove("collapsible-active-button");
    step2btnform3.classList.add("collapsible-inactive-button");
    step2form2.style.display = "none";
    step2form3.style.display = "none";
    if (step2form1assessmentText && step2form2assessmentText && step2form3assessmentText) {
      step2form1assessmentText.style.display = "block";
      step2form2assessmentText.style.display = "none";
      step2form3assessmentText.style.display = "none";
    }
  } else if (step2form2 && step2form2.style.display !== "none") {
    step2btnform2.classList.add("collapsible-active-button");
    step2btnform1.classList.remove("collapsible-active-button");
    step2btnform1.classList.add("collapsible-inactive-button");
    step2btnform3.classList.remove("collapsible-active-button");
    step2btnform3.classList.add("collapsible-inactive-button");
    step2form1.style.display = "none";
    step2form3.style.display = "none";
    if (step2form1assessmentText && step2form2assessmentText && step2form3assessmentText) {
      step2form2assessmentText.style.display = "block";
      step2form1assessmentText.style.display = "none";
      step2form3assessmentText.style.display = "none";
    }
  } else if (step2form3 && step2form3.style.display !== "none") {
    step2btnform3.classList.add("collapsible-active-button");
    step2btnform1.classList.remove("collapsible-active-button");
    step2btnform1.classList.add("collapsible-inactive-button");
    step2btnform2.classList.remove("collapsible-active-button");
    step2btnform2.classList.add("collapsible-inactive-button");
    step2form1.style.display = "none";
    step2form2.style.display = "none";
    if (step2form1assessmentText && step2form2assessmentText && step2form3assessmentText) {
      step2form3assessmentText.style.display = "block";
      step2form1assessmentText.style.display = "none";
      step2form2assessmentText.style.display = "none";
    }
  }
}

window.onload = function() {
  const step3form1 = document.getElementById('step3form1');
  const step3form2 = document.getElementById('step3form2');
  const step3form3 = document.getElementById('step3form3');
  const step3btnform1 = document.getElementById('step3btnform1');
  const step3btnform2 = document.getElementById('step3btnform2');
  const step3btnform3 = document.getElementById('step3btnform3');
  
  step3form1.style.display = "block";
  step3form2.style.display = "none";
  step3form3.style.display = "none";
  step3btnform1.classList.add("collapsible-active-button");
  step3btnform2.classList.add("collapsible-inactive-button");
  step3btnform3.classList.add("collapsible-inactive-button");

  const step2form1 = document.getElementById('step2form1');
  const step2form2 = document.getElementById('step2form2');
  const step2form3 = document.getElementById('step2form3');
  const step2btnform1 = document.getElementById('step2btnform1');
  const step2btnform2 = document.getElementById('step2btnform2');
  const step2btnform3 = document.getElementById('step2btnform3');
  
  step2form1.style.display = "block";
  step2form2.style.display = "none";
  step2form3.style.display = "none";
  step2btnform1.classList.add("collapsible-active-button");
  step2btnform2.classList.add("collapsible-inactive-button");
  step2btnform3.classList.add("collapsible-inactive-button");
};  