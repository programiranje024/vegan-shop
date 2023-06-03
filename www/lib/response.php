<?php

function show_error($message) {
  echo "<div class='alert alert-danger' role='alert'>$message</div>";
}

function show_success($message) {
  echo "<div class='alert alert-success' role='alert'>$message</div>";
}
