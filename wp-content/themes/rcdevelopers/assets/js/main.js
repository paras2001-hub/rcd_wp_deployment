$(document).ready(function () {
  const homeSections = document.querySelectorAll("section");
  const navList = document.querySelectorAll("nav ul .nav-item");

  $(window).scroll(function () {
    var currentNav = "";
    homeSections.forEach((section) => {
      const sectionTop = section.offsetTop;
      if (scrollY >= sectionTop - 60) {
        currentNav = section.getAttribute("id");
      }
      navList.forEach((li) => {
        console.log(li);
        li.classList.remove("active");
        if (li.classList.contains(currentNav)) {
          li.classList.add("active");
        }
      });
    });
  });

  // Form Progress Indicator (for Sign Up Form)
  const steps = document.querySelectorAll(".form-input");

  if (steps.length > 0) {
    const progressButton = document.getElementById("progress-button");
    const submitButton = document.getElementById("submit-button");

    let currentStep = 0;
    steps[currentStep].classList.add("active");

    progressButton.addEventListener("click", function () {
      const inputs = steps[currentStep].querySelectorAll(
        "input, textarea, select"
      );
      let isComplete = true;
      inputs.forEach((input) => {
        if (!input.value) {
          isComplete = false;
          input.classList.add("incomplete");
        } else {
          input.classList.remove("incomplete");
        }
      });

      if (!isComplete) {
        alert("Please complete all fields before proceeding.");
        return;
      }

      if (currentStep < steps.length - 1) {
        steps[currentStep].classList.add("fade-out-left");
        setTimeout(() => {
          steps[currentStep].classList.remove("active");
          steps[currentStep].classList.remove("fade-out-left");
        }, 500);

        currentStep++;

        const stepWidth = 100 / steps.length;
        progressButton.style.left = `${Math.min(
          stepWidth * currentStep,
          100
        )}%`;
        submitButton.style.left = `${Math.min(stepWidth * currentStep, 100)}%`;

        setTimeout(() => {
          steps[currentStep].classList.add("fade-in-right");
        }, 500);

        setTimeout(() => {
          steps[currentStep].classList.add("active");
          steps[currentStep].classList.remove("fade-in-right");
        }, 510);

        if (currentStep === steps.length - 1) {
          progressButton.style.display = "none";
          submitButton.style.display = "block";
        }
      }
    });
  }

  // Dashboard Navigation
  const navItems = document.querySelectorAll(
    ".dashboard-content .nav-menu .nav-item"
  );
  const dashboardSections = document.querySelectorAll(".dashboard-section");

  if (navItems.length > 0) {
    navItems.forEach((item) => {
      item.addEventListener("click", function (e) {
        e.preventDefault();
        const target = this.getAttribute("data-target");

        navItems.forEach((nav) => nav.classList.remove("current"));
        this.classList.add("current");

        dashboardSections.forEach((section) => {
          if (section.id === target) {
            section.classList.add("active");
            setTimeout(() => {
              section.classList.remove("hidden");
            }, 500);
          } else {
            section.classList.remove("active");
            setTimeout(() => {
              section.classList.add("hidden");
            }, 500); // Match the transition duration
          }
        });
      });
    });
  }

  // Dashboard Navigation
  const navItemsClient = document.querySelectorAll(
    ".dashboard-content .nav-menu-client .nav-item"
  );
  const dashboardClientSections = document.querySelectorAll(
    ".client-dashboard-section"
  );

  if (navItemsClient.length > 0) {
    navItemsClient.forEach((item) => {
      item.addEventListener("click", function (e) {
        e.preventDefault();
        const target = this.getAttribute("data-target");

        navItemsClient.forEach((nav) => nav.classList.remove("current"));
        this.classList.add("current");

        dashboardClientSections.forEach((section) => {
          if (section.id === target) {
            section.classList.add("active");
            setTimeout(() => {
              section.classList.remove("hidden");
            }, 500);
          } else {
            section.classList.remove("active");
            setTimeout(() => {
              section.classList.add("hidden");
            }, 500); // Match the transition duration
          }
        });
      });
    });
  }

  // Double-tap to edit fields
  let lastTap = 0;
  $(".editable").on("touchend click", function (e) {
    const currentTime = new Date().getTime();
    const tapLength = currentTime - lastTap;
    lastTap = currentTime;
    if (tapLength < 500 && tapLength > 0) {
      const field = $(this).data("field");
      const currentValue = $(this).text().trim();
      const input = $("<input>", {
        type: "text",
        value: currentValue,
        class: "edit-input",
        blur: function () {
          const newValue = $(this).val().trim();
          $(this).parent().text(newValue).removeClass("editing");
          // Save the new value via AJAX or form submission
          // Example: saveField(field, newValue);
        },
        keyup: function (e) {
          if (e.key === "Enter") {
            $(this).blur();
          }
        },
      });
      $(this).empty().append(input).addClass("editing");
      input.focus();
    }
  });

  // Double-click to edit fields
  $(".editable").on("dblclick", function () {
    const field = $(this).data("field");
    const currentValue = $(this).text().trim();
    if ($(this).find("select").length > 0) {
      return;
    }
    if (
      field === "state" ||
      field === "existing_business" ||
      field === "languages"
    ) {
      const select = $("<select>", {
        class: "edit-select",
        blur: function () {
          const newValue = $(this).val();
          $(this).parent().text(newValue).removeClass("editing");
          // Save the new value via AJAX or form submission
          // Example: saveField(field, newValue);
        },
        keyup: function (e) {
          if (e.key === "Enter") {
            $(this).blur();
          }
        },
      });
      // Add options to the select element
      if (field === "state") {
        select.append(
          new Option("State 1", "state1", currentValue === "state1")
        );
        select.append(
          new Option("State 2", "state2", currentValue === "state2")
        );
        select.append(
          new Option("State 3", "state3", currentValue === "state3")
        );
      } else if (field === "existing_business") {
        select.append(
          new Option("Business 1", "business1", currentValue === "business1")
        );
        select.append(
          new Option("Business 2", "business2", currentValue === "business2")
        );
        select.append(
          new Option("Business 3", "business3", currentValue === "business3")
        );
      } else if (field === "languages") {
        select.append(
          new Option("Language 1", "language1", currentValue === "language1")
        );
        select.append(
          new Option("Language 2", "language2", currentValue === "language2")
        );
        select.append(
          new Option("Language 3", "language3", currentValue === "language3")
        );
      }
      $(this).empty().append(select).addClass("editing");
      select.focus();
    } else {
      const input = $("<input>", {
        type: "text",
        value: currentValue,
        class: "edit-input",
        blur: function () {
          const newValue = $(this).val().trim();
          $(this).parent().text(newValue).removeClass("editing");
          // Save the new value via AJAX or form submission
          // Example: saveField(field, newValue);
        },
        keyup: function (e) {
          if (e.key === "Enter") {
            $(this).blur();
          }
        },
      });
      $(this).empty().append(input).addClass("editing");
      input.focus();
    }
  });

  // featured news paginator
  const featuredNewsTiles = document.querySelectorAll(".featured-news-tile");

  const itemsPerPage = 4;
  let currentPage = 0;

  const nextButton = document.getElementById("featured-next-button");
  const prevButton = document.getElementById("featured-prev-button");

  function updateButtons() {
    prevButton.disabled = currentPage === 0;
    nextButton.disabled =
      (currentPage + 1) * itemsPerPage >= featuredNewsTiles.length;
  }

  function loadItems() {
    const start = currentPage * itemsPerPage;
    const end = Math.min(start + itemsPerPage, featuredNewsTiles.length - 1);

    for (let i = 0; i < featuredNewsTiles.length; i++) {
      featuredNewsTiles[i].classList.add("hide");
    }

    for (let i = start; i < end; i++) {
      featuredNewsTiles[i].classList.remove("hide");
    }

    if (start === end) {
      featuredNewsTiles[end].classList.remove("hide");
    }

    updateButtons();
  }

  if (nextButton && prevButton) {
    prevButton.addEventListener("click", () => {
      if (currentPage > 0) {
        currentPage--;
        loadItems();
      }
    });

    nextButton.addEventListener("click", () => {
      if ((currentPage + 1) * itemsPerPage < featuredNewsTiles.length) {
        currentPage++;
        loadItems();
      }
    });

    // Load the first set of items on page load
    loadItems();
  }

  // editors news paginator
  const editorsNewsTiles = document.querySelectorAll(".editors-news-tile");

  const itemsPerEditorPage = 4;
  let currentEditorPage = 0;

  const editorNextButton = document.getElementById("editors-next-button");
  const editorPrevButton = document.getElementById("editors-prev-button");

  function updateEditorButtons() {
    editorPrevButton.disabled = currentEditorPage === 0;
    editorNextButton.disabled =
      (currentEditorPage + 1) * itemsPerEditorPage >= editorsNewsTiles.length;
  }

  function loadEditorItems() {
    const start = currentEditorPage * itemsPerEditorPage;
    const end = Math.min(
      start + itemsPerEditorPage,
      editorsNewsTiles.length - 1
    );

    for (let i = 0; i < editorsNewsTiles.length; i++) {
      editorsNewsTiles[i].classList.add("hide");
    }

    for (let i = start; i < end; i++) {
      editorsNewsTiles[i].classList.remove("hide");
    }

    if (start === end) {
      editorsNewsTiles[end].classList.remove("hide");
    }

    updateEditorButtons();
  }

  if (editorNextButton && editorPrevButton) {
    editorPrevButton.addEventListener("click", () => {
      if (currentEditorPage > 0) {
        currentEditorPage--;
        loadEditorItems();
      }
    });

    editorNextButton.addEventListener("click", () => {
      if (
        (currentEditorPage + 1) * itemsPerEditorPage <
        editorsNewsTiles.length
      ) {
        currentEditorPage++;
        loadEditorItems();
      }
    });

    // Load the first set of items on page load
    loadEditorItems();
  }

  function searchFunctionality(searchInput, tableBody, resultsCount) {
    const clientSearch = searchInput;

    if (clientSearch) {
      clientSearch.addEventListener("input", function () {
        const tableList = tableBody;
        const filter = clientSearch.value.toUpperCase();

        const rows = tableList.getElementsByTagName("tr");

        let count = 0;

        for (i = 0; i < rows.length; i++) {
          const td = rows[i].getElementsByTagName("td");
          if (td) {
            let textValue = "";
            for (let j = 0; j < td.length; j++) {
              textValue += td[j].textContent || td[j].innerText;
            }
            if (textValue.toUpperCase().indexOf(filter) > -1) {
              count++;
              rows[i].style.display = "";
            } else {
              rows[i].style.display = "none";
            }
          }
        }

        const resultCount = resultsCount;
        if (count === 0) {
          resultCount.textContent = "No results found";
        } else {
          resultCount.innerHTML = `Showing ${count} result/s`;
        }
      });
    }
  }

  searchFunctionality(
    document.getElementById("client-search"),
    document.getElementById("leads-table-body"),
    document.getElementById("results-count")
  );

  searchFunctionality(
    document.getElementById("payment-search"),
    document.getElementById("payments-table-body"),
    document.getElementById("payments-results-count")
  );

  searchFunctionality(
    document.getElementById("booking-search"),
    document.getElementById("booking-table-body"),
    document.getElementById("booking-results-count")
  );

  const templateWrapper = document.getElementById("template-grid");
  const templateList = document.querySelectorAll(".template-preview");

  if (templateWrapper) {
    templateList[0].classList.add("selected-template");
    updateTemplate();
    templateList.forEach((template) => {
      template.addEventListener("click", function () {
        const selectedTemplate = document.querySelector(".selected-template");
        if (selectedTemplate) {
          selectedTemplate.classList.remove("selected-template");
        }
        this.classList.add("selected-template");
        updateTemplate();
      });
    });
  }

  function updateTemplate() {
    const selectedTemplate = document.querySelector(".selected-template");
    const templateId = selectedTemplate.dataset.id;
    const templateName = selectedTemplate.dataset.template_name;
    const templateStyle = selectedTemplate.dataset.template_style;
    const width = selectedTemplate.dataset.width;
    const height = selectedTemplate.dataset.height;
    const templateDocUrl = selectedTemplate.dataset.template_doc_address;

    document.getElementById("template-view").src = templateDocUrl;
    document.getElementById("template-title").textContent = ` ${templateName}`;
    document.getElementById("template-style").textContent = ` ${templateStyle}`;
    document.getElementById(
      "template-resolution"
    ).textContent = ` ${width} x ${height}`;

    document.getElementById("template-input").value = templateId;
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("image-modal");
  const modalImage = document.getElementById("modal-image");
  const closeModal = document.querySelector(".close-modal");
  const previewLinks = document.querySelectorAll(".preview-link");

  if (previewLinks) {
    previewLinks.forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        const imageUrl = this.dataset.image;
        modalImage.src = imageUrl;
        modal.style.display = "flex";
      });
    });

    closeModal.addEventListener("click", function () {
      modal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
      if (e.target === modal) {
        modal.style.display = "none";
      }
    });
  }
});
