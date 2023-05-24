<template>
  <div class="main-container">
        <div class="main-wrap">
            <div class="infomation-wrap">
                <div class="info-title">{{ title }}</div>
                <div class="infomation-container">
                    <div class="info-wrap">
                        <img :src="require('../assets/images/avatar.png')" />
                        <div class="info-name">{{ userName }}</div>
                        <div class="info-mail">&lt;{{ email }}&gt;</div>
                    </div>
                    <div class="info-time">{{ time }}</div>
                </div>
            </div>
            <div class="mail-wrap">
                {{ content }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
  name: "Notify",
}
</script>

<style>

</style>