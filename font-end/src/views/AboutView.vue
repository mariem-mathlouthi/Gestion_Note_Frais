<!-- AboutView.vue -->

<template>
  <div class="about">
    <section class="py-5 text-center">
      <div class="container my-5">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="display-3 fw-bold mb-4 text-black">About Our App</h1>
            <p class="lead text-black">Welcome to our application for efficient management of expense notes - COSTSAVVY.</p>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-lg-6">
            <h2 class="mb-4 text-black">Why COSTSAVVY?</h2>
            <p class="lead text-black">COSTSAVVY is designed to simplify your expense tracking, providing a user-friendly interface and powerful features to streamline the process of managing and organizing your expense notes.</p>
          </div>
          <div class="col-lg-6">
            <h2 class="mb-4 text-black">Key Features</h2>
            <ul class="list-group">
              <li class="list-group-item text-black">Easy expense entry and categorization</li>
              <li class="list-group-item text-black">Real-time expense tracking</li>
              <li class="list-group-item text-black">Report generation for better insights</li>
              <!-- Add more features as needed -->
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "AboutView",
};
</script>

<style scoped>
/* Custom styles go here */
.about {
  background-color: #f9f9f9;
  padding: 60px 0;
}

.display-3 {
  color: #000;
}

.lead {
  color: #000;
}

.list-group-item {
  background-color: #f0f0f0;
  border: none;
  color: #000;
}

.list-group-item:hover {
  background-color: #e0e0e0;
}
</style>
