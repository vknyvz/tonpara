<?php

function user() {
  return \Auth::guard()->user();
}