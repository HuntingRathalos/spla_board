<script setup lang="ts">
const handleEmailVerification = async () => {
  const { data, error } = await useApiFetch('/api/email/verification-notification', { method: 'POST' });
  if (!error) {
    // storeからupdateUserを呼ぶ
  }
};
</script>

<template>
  <div>メール認証してください。</div>
  <button @click="handleEmailVerification">メール認証</button>
</template>
