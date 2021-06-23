<template>
  <div class="container">
    <div class="row justify-content-center">CREATE USER</div>
    <form class="mb-3" @submit.prevent="addUser">
      <div class="formgroup">
        <input
          class="input form-control"
          placeholder="Full Name"
          v-model="user.fullName"
        />
        <input type="email"
          class="input form-control"
          placeholder="Email"
          v-model="user.email"
        />
        <input
          class="input form-control"
          placeholder="Password"  minlength="8"
          v-model="user.password"
        />
        <input
          class="input form-control"
          placeholder="Confirm Password"  minlength="8"
          v-model="user.nominatedPassword"
        />
        <button type="submit">Save</button>
      </div>
    </form>
    
    <div class="row justify-content-center">USER LIST</div>
    <div v-for="user in users" v-bind:key="user.id">
      <button @click="deleteUser(user.id)"> Delete</button>

      ({{ user.id }}) name: {{ user.fullName }} email: {{ user.email }}  password: {{ user.password }} 
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      user: {
        id: "",
        fullName: "",
        nominatenPassword: "",
        password: "",
        email: "",
      },
      user_id: "",
    };
  },
  created() {
    this.fetchUsers();
  },

  methods: {
    fetchUsers() {
      fetch("api/users")
        .then((res) => res.json())
        .then((res) => {
          this.users = res.data;
        });
    },
    deleteUser(id) {
      fetch("api/delete-user/"+id, {method: 'delete'})
        .then((res) => res.json())
        .then(this.fetchUsers);
    },
    addUser() {
      var found = 0;
      var emailinput = this.user.email;
      this.users.forEach(function(user){
      if(user.email == emailinput){
        found = user.id;
      }
      });

      if (this.user.password === this.user.nominatedPassword) {
        if(found == 0 ){
          fetch("api/create-user", {
            method: "post",
            body: JSON.stringify(this.user),
            headers: { "content-type": "application/json" },
          })
            .then((res) => res.json())
            .then((data) => {
              this.user.fullName = "";
              this.user.email = "";
              this.user.password = "";
              this.user.nominatedPassword = "";
              alert("User Added!");
              this.fetchUsers();
            });
        }else{
          alert("email already in use!");
        }
      } else {
        alert("password mismatch!");
        this.fetchUsers();
      }
    },
  },
};
</script>