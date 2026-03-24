"use strict";
$(function () {
  function ratingEnable() {
    $(".u-rating-square").barrating("show", {
      theme: "bars-square",
      showValues: true,
      showSelectedRating: false,
    });
    $(".u-rating-movie").barrating("show", {
      theme: "bars-movie",
    });
    // Set the rating for the first .u-rating-movie element
    $(".u-rating-movie").barrating("set", "2");

    // Apply barrating to elements with class .u-rating-square
    $(".u-rating-square").barrating("show", {
      theme: "bars-square",
      showValues: true,
      showSelectedRating: false,
    });
    $(".rating-widget").each(function () {
      const $ratingElement = $(this);
      const theme = $ratingElement.data("theme");
      const initialRating = $ratingElement.data("current-rating");

      $ratingElement.barrating({
        theme: theme || "fontawesome-stars",
        showSelectedRating: false,
        initialRating: initialRating || "0",
        onSelect: function (value, text) {
          const container = $ratingElement.closest(".rating-container");
          if (!value) {
            $ratingElement.barrating("clear");
            container.find(".your-rating").addClass("hidden");
            container.find(".current-rating").removeClass("hidden");
          } else {
            container.find(".current-rating").addClass("hidden");
            container
              .find(".your-rating")
              .removeClass("hidden")
              .find("span")
              .html(value);
          }
        },
        onClear: function () {
          const container = $ratingElement.closest(".rating-container");
          container.find(".your-rating").addClass("hidden");
          container.find(".current-rating").removeClass("hidden");
        },
      });
    });
    $(".view-rating-widget").each(function () {
      const $ratingElement = $(this);
      const theme = $ratingElement.data("theme");
      const initialRating = $ratingElement.data("current-rating");

      $ratingElement.barrating({
        theme: theme || "fontawesome-stars",
        showSelectedRating: false,
        initialRating: initialRating || "0",
        readonly: true, 
        onSelect: function (value, text) {
          const container = $ratingElement.closest(".rating-container");
          if (!value) {
            $ratingElement.barrating("clear");
            container.find(".your-rating").addClass("hidden");
            container.find(".current-rating").removeClass("hidden");
          } else {
            container.find(".current-rating").addClass("hidden");
            container
              .find(".your-rating")
              .removeClass("hidden")
              .find("span")
              .html(value);
          }
        },
        onClear: function () {
          const container = $ratingElement.closest(".rating-container");
          container.find(".your-rating").addClass("hidden");
          container.find(".current-rating").removeClass("hidden");
        },
      });
    });

    // Clear Rating Handler (Optional)
    $(".clear-rating").click(function (event) {
      event.preventDefault();
      const $target = $(this)
        .closest(".rating-container")
        .find(".rating-widget");
      $target.barrating("clear");
    });
  }
  ratingEnable();
});
