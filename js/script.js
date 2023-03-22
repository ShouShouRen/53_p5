$(function () {
  function checkit() {
    let selectedCells = [];
    $("td[data-id]").click(function () {
      const index = $(this).data("id") - 1;
      if (selectedCells.length < 2 && !selectedCells.includes(index)) {
        selectedCells.push(index);
        $(this).addClass("selected");
      } else if (selectedCells.includes(index)) {
        selectedCells.splice(selectedCells.indexOf(index), 1);
        $(this).removeClass("selected");
      }
    });
    $("#checkit").click(function () {
      if (selectedCells.length === 2) {
        const row1 = Math.floor(selectedCells[0] / 2);
        const col1 = selectedCells[0] % 2;
        const row2 = Math.floor(selectedCells[1] / 2);
        const col2 = selectedCells[1] % 2;
        if (
          (row1 === row2 && Math.abs(col1 - col2) === 1) ||
          (col1 === col2 && Math.abs(row1 - row2) === 1)
        ) {
          alert("登入成功");
          location.href = "index.php";
        } else {
          alert("二次驗證錯誤");
          location.href = "logout.php";
        }
      }
    });
  }
  checkit();

  let deftime = 60;
  let timer, confirmTimer, counter;
  const startConfirmTimer = () => {
    confirmTimer = setTimeout(() => {
      let count = 4;
      counter = setInterval(() => {
        $("#countdownModal").text(count--);
        if (count < 0) {
          location.href = "logout.php";
          clearInterval(counter);
        }
      }, 1000);
    }, 1000);
  };
  const startTimer = () => {
    clearInterval(timer);
    timer = setInterval(() => {
      $("#countdown").html(`${deftime--} 秒`);
      if (deftime < 0) {
        clearInterval(timer);
        $("#confirmModal").modal("show");
        startConfirmTimer();
      }
    }, 1000);
  };
  const resetConfirmTimer = () => {
    clearTimeout(confirmTimer);
    $("#confirmModal").modal("hide");
    deftime = parseInt($("#timeInput").val());
    startTimer();
  };
  const setTime = () => {
    deftime = parseInt($("#timeInput").val());
    startTimer();
  };
  const resetTime = () => {
    clearInterval(timer);
    deftime = parseInt($("#timeInput").val());
    startTimer();
  };
  $("#setTimeBtn").on("click", setTime);
  $("#resetTimeBtn").on("click", resetTime);
  $("#timerModal").on("show.bs.modal", () => {
    clearInterval(timer);
    setTime();
  });
  $("#timerModal").on("hide.bs.modal", () => {
    clearInterval(timer);
  });
  $("#continueBtn").on("click", () => {
    clearTimeout(confirmTimer);
    resetConfirmTimer();
    $("#confirmModal").modal("hide");
    resetTime();
    clearInterval(counter);
    clearTimeout(confirmTimer);
  });
  $("#cancelBtn").on("click", () => {
    window.location.href = "logout.php";
  });
  $("#confirmModal").on("hidden.bs.modal", () => {
    $("#countdownModal").text(5);
  });
  setTime();

  $(".getmember").click(function () {
    let member_id = $(this).data("id");
    $.ajax({
      url: "get_member.php",
      type: "GET",
      data: {
        id: member_id,
      },
      dataType: "JSON",
      success: function (resopnse) {
        $("#user").val(resopnse[0].user);
        $("#user_name").val(resopnse[0].user_name);
        $("#pw").val(resopnse[0].pw);
        $("#id").val(resopnse[0].id);
      },
    });
  });

  $(".savemember").click(function () {
    let user = $("#user").val();
    let user_name = $("#user_name").val();
    let pw = $("#pw").val();
    let id = $("#id").val();
    let data = {
      user: user,
      user_name: user_name,
      pw: pw,
      id: id,
    };
    $.ajax({
      url: "save_member.php",
      type: "POST",
      data: JSON.stringify(data),
      contentType: "application/json",
      success: function (resopnse) {
        location.reload();
      },
    });
  });
});
