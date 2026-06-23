"use strict";
(function ($) {
  $(document).ready(function () {
    //Checking to see if subject field exists before using it
    var e = document.getElementById("subjectId");
    if (e) {
      var strUser = e.options[0].innerHTML;
      $("#subject").val(strUser);
    }

    // Select all select elements with 'data-selectbox' included then init selectBox custom selector
    $('select[data-selectbox!=""]').selectBox();
  });

  $("#subjectId").change(function () {
    var val = this.value;
    var label = this.options[this.selectedIndex].innerHTML;
    $("#toEmail").val(val);
    $("#subject").val(label);
  });
  function datePicker() {
    $(".datepicker").each(function (index, Element) {
      let $this = $(this);
      $this.datepicker();
    });
  }
  datePicker();
  // DATE PICKER

  // DATE RANGE
  $(function () {
    var dateFormat = "mm/dd/yy",
      from = $("#from")
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
        })
        .on("change", function () {
          to.datepicker("option", "minDate", getDate(this));
        }),
      to = $("#to")
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
        })
        .on("change", function () {
          from.datepicker("option", "maxDate", getDate(this));
        });

    function getDate(element) {
      var date;
      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }
  });
  let openForm = $(".open-form-link");
  openForm.magnificPopup({
    type: "inline",
    gallery: {
      enabled: true,
    },
    midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
  openForm.on("click", function (e) {
    datePicker();
  });

  // Moved throttle to global script.js for reuse

  // Attraction area autocomplete
  let suggestionsNode = $('<div class="suggestions"></div>');
  let areaSearch = $(".areaSearch");
  if (areaSearch.length > 0) {
    //Append to area search parent rather than body
    areaSearch.parent().append(suggestionsNode);
    let as;

    //Reposition autocomplete based on input position
    // Altered to position the autocomplete going upwards if it would go off the screen and over half the height of the window
    function positionSuggestions() {
      if (as) {
        var pos = as.offset();
        // Adding compensation of position for google translates bar at the top (which makes body relative and moves it down)
        var st = $(".skiptranslate");
        var stoffset = 0;
        if (
          st.length > 0 &&
          st.css("display") != "none" &&
          st.children("iframe").length > 0
        ) {
          stoffset = st.children("iframe").outerHeight();
        }
        var topPos = pos.top - stoffset;
        var asHeight = as.outerHeight();
        var cssUpdate = {
          width: as.outerWidth(),
          top: "",
          bottom: "",
          marginBottom: -10,
          marginTop: -10,
        };
        //position above or below depending on screen position
        // As no longer fixed adjust for scroll
        if (
          topPos + asHeight + 200 > window.outerHeight + window.scrollY &&
          topPos > window.outerHeight / 2
        ) {
          cssUpdate.bottom = "100%";
        } else {
          cssUpdate.top = "100%";
        }
        suggestionsNode.css(cssUpdate);
      }
    }
    $(window).on("resize scroll", function () {
      positionSuggestions();
    });

    $(".mobileAltSearch").on("click", function (e) {
      $("#attractions-form-block").toggleClass("showForm");
      e.preventDefault();
    });

    //Having a default set of areas when no term has been added and keyboard controls (from old site)
    const searchDefaults = [
      "British Isles",
      "England",
      "Island of Ireland",
      "Scotland",
      "Wales",
    ];
    let highlighted = 0;
    let searchReq;
    function ensureonscreen(hov) {
      // Safety check to ensure both the highlighted item and autocomplete exist before checking it's position
      if (hov.length > 0 && suggestionsNode.length > 0) {
        var hovpos = hov.position();
        if (
          hovpos.top + hov.outerHeight(true) + suggestionsNode.scrollTop() >
          suggestionsNode.height()
        ) {
          suggestionsNode.scrollTop(
            hovpos.top +
              hov.outerHeight() +
              suggestionsNode.scrollTop() -
              suggestionsNode.outerHeight()
          );
        } else if (hovpos.top < suggestionsNode.scrollTop()) {
          suggestionsNode.scrollTop(suggestionsNode.scrollTop() + hovpos.top);
        }
        var hovpos = hov.offset();
        var b = $("body");
        if (
          hovpos.top + hov.outerHeight() >
          b.scrollTop() + $(window).height()
        ) {
          $(window).scrollTop(
            hovpos.top + hov.outerHeight() - $(window).height()
          );
        } else if (hovpos.top < b.scrollTop()) {
          $(window).scrollTop(hovpos.top);
        }
      }
    }

    //Initialise jquwery selectbox https://github.com/marcj/jquery-selectBox
    $("select").selectBox({
      mobile: true
    });

    // Submit form on filter change
    $(".changeSubmit").on("change", function (e) {
      //Checking that the area is filled in before submitting
      if (e.target.form.area.value.length > 0) {
        e.target.form.submit();
      }
    });
    // Save last search
    var lastSearch = "";
    areaSearch
      .on("keyup focus", function (e) {
        as = $(this);
        const q = this.value;
        // Prevent request overlap on slow typing
        if (searchReq) {
          searchReq.abort();
        }
        // Query the server for matching areas, or use default if empty
        if (q.length > 0) {
          //Improving search by not repeating query on all key presses
          if (q != lastSearch) {
            suggestionsNode.empty();
            searchReq = $.getJSON(
              "/areas.json?q=" + this.value,
              function (data) {
                suggestionsNode.html(
                  '<div class="suggestList">' +
                    [].map
                      .call(data.data, function (s) {
                        return (
                          '<div class="' +
                          s.country.toLowerCase().replace(/\s/gi, "") +
                          '">' +
                          s.title +
                          "</div>"
                        );
                      })
                      .join("") +
                    "</div>"
                );
                suggestionsNode
                  .children(".suggestList")
                  .children()
                  .on("click", function () {
                    as.val(this.textContent);
                  });
                positionSuggestions();
              }
            );
            lastSearch = q;
          }
        } else {
          suggestionsNode.html(
            '<div class="suggestList">' +
              [].map
                .call(searchDefaults, function (s) {
                  return (
                    '<div class="' +
                    s.toLowerCase().replace(/\s/gi, "") +
                    '">' +
                    s +
                    "</div>"
                  );
                })
                .join("") +
              "</div>"
          );
          suggestionsNode
            .children(".suggestList")
            .children()
            .on("click", function () {
              as.val(this.textContent);
            });
          positionSuggestions();
        }
        var charCode = typeof e.which == "number" ? e.which : e.keyCode;
        var ac = suggestionsNode.children(".suggestList");
        //Keyboard controls for autocomplete
        switch (charCode) {
          case 38:
            highlighted--;
            if (highlighted < 0) {
              highlighted += ac.children().length;
            }
            var hov = ac
              .children()
              .removeClass("hovered")
              .filter(":eq(" + highlighted + ")")
              .addClass("hovered");
            ensureonscreen(hov);
            break;
          case 40:
            highlighted++;
            if (highlighted >= ac.children().length) {
              highlighted -= ac.children().length;
            }
            var hov = ac
              .children()
              .removeClass("hovered")
              .filter(":eq(" + highlighted + ")")
              .addClass("hovered");
            ensureonscreen(hov);
            break;
          case 13:
            if (ac.filter(":visible").length > 0) {
              //Altering so enter press doesn't automatically pick a suggestion if one hasn't been chosen
              var hovered = ac.children(".hovered");
              if (hovered.length > 0) {
                hovered.click();
                // closing autocomplete without losing focus
                ac.hide();
                e.preventDefault();
              } else {
                e.target.form.submit();
              }
            } else {
              //Submit form if autocomplete is not in use
              e.target.form.submit();
            }
            break;
        }
      })
      .on("keydown", function (e) {
        // Preventing enter submitting form
        var charCode = typeof e.which == "number" ? e.which : e.keyCode;
        if (charCode == 13) {
          e.preventDefault();
        }
      })
      .on("blur", function () {
        // Removing autocomplete after leaving
        setTimeout(function () {
          suggestionsNode.empty();
        }, 300);
      });
  }

  $(document).ready(function () {
    rescaleSelectBox();
    rescaleGoogleLangBox();
  });

  // On window resize
  $(window).resize(function() {
    rescaleSelectBox();
    rescaleGoogleLangBox();
  });


  function rescaleSelectBox() {
    // Go through each selectBox, ensure that the width is set to the parent. This fixes an iOS specific bug
    // Was causing google translate to expand so added a specific case
    $(".selectBox:not(.goog-te-combo)").each( function (e) {
      var thisParent = $(this).parent();

      // Temp fix to force attraction form search to the same width as the search term
      if (thisParent.hasClass('attractionFormSearch')) {
        var newWidth = $(".searchTerm").width();
        $(this).css({"width": newWidth});
        thisParent.width = newWidth;
      } else {
        $(this).css({"width": thisParent.width()});
      }
    });
  }

  function rescaleGoogleLangBox() {
    // Force width to 250px on smaller screens
    $(".goog-te-combo").each( function (e) {
      if ($(window).width() < mobileBreakpoint) {
        $(".goog-te-combo").width('250px');
      } else {
        $(".goog-te-combo").width('190px');
      }
    });
  }

})(jQuery); // Fully reference jQuery after this point.


