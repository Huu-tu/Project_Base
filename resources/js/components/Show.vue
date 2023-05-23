<template>
    <div class="container">
      <div class="main-container">
        <div class="infomation-wrap">
          <div class="info-title">{{ title }}</div>
          <div class="infomation-container">
            <div class="info-wrap">
              <img :src="require('../assets/google.png')" />
              <div class="info-name">{{ userName }}</div>
              <div class="info-mail">&lt;{{ email }}&gt;</div>
            </div>
            <div class="info-time">{{ time }}</div>
          </div>
        </div>
        <div class="mail-wrap">
          {{ content }}
        </div>
        <div class="nav-wrap">
          <button
            type="button"
            class="btn btn-primary"
            data-toggle="modal"
            data-target="#modalAccepted"
          >
            Xác nhận
          </button>
          <div
            class="modal fade"
            id="modalAccepted"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalAcceptedLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <span class="material-symbols-outlined accepted"> check_circle </span>
                  <div class="model-content">Đã duyệt đơn thành công!</div>
                </div>
              </div>
            </div>
          </div>
  
          <button
            type="button"
            class="btn btn-danger"
            data-toggle="modal"
            data-target="#modalCanceled"
          >
            Từ chối
          </button>
          <div
            class="modal fade"
            id="modalCanceled"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalCanceledLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <span class="material-symbols-outlined canceled"> cancel </span>
                  <div class="model-content">Đã từ chối!</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: "Show",
    props: {
      title: String,
      userName: String,
      email: String,
      time: Date,
      content: String,
    },
    data() {
      return {};
    },
    methods: {},
  };
  </script>
  
  <style>
  .modal-content {
    background: #ffffff !important;
    border: 1px solid #000000 !important;
    border-radius: 50px !important;
    height: 120px;
  }
  
  .modal-body {
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    font-weight: 400;
    line-height: 23px;
    font-family: var(--font-style);
  }
  
  .modal-body span {
    font-size: 36px;
    margin-right: 10px;
  }
  
  .modal-body span.accepted {
    color: #4EBF19;
  }
  
  .modal-body span.canceled {
    color: #dc3545;
  }
  
  </style>