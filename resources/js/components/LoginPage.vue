<template>
  <div class="container">
    <div v-if="user.fullName == ''">
      <div class="row justify-content-center">LOGIN</div>
      <div class="formgroup">
        <input pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"
          class="input form-control"
          placeholder="Email" 
          v-model="email"
        />
        <input
          class="input form-control"
          placeholder="Password"  minlength="8"
          v-model="password"
        />
        <button @click.prevent='loginClick()' style="width:100%">Login</button>
      </div>
    </div>
    <div v-if="user.fullName != ''">
    Logged in user: {{user.fullName}}
    <button @click="reset()">Logout</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return this.initialState();
  },
  created() {
    this.fetchUsers();
  },

  methods: {
    fetchUsers() {
      fetch("api/login")
        .then((res) => res.json())
        .then((res) => {
          this.users = res.data;
        });
    },
    redirectToDashboard(id) {
      fetch("api/login/"+id)
        .then((res) => res.json())
        .then((res) => {
          this.user = res.data;
        });
    },
    loginClick() {
      var pass = this.password;
      var email = this.email;
      var found = 0;
      //loop through all users check email if correct
      this.users.forEach(function(user){
        if(user.email == email){
          //if email found check password if correct
          if(user.password == pass){
            found = user.id;
          }
        }
      });
      //if account is found
      if(found != 0){
        this.redirectToDashboard(found);
      }else{
        alert("email or password doesn't match");
      }

    },
    reset() {
        //make data into initial state
        Object.assign(this.$data, this.initialState());
        this.fetchUsers();
    },
    initialState() {
      //used for resetting user for logout
        return {
        email: "",
        password: "",
        users: [],
        user: {
          id: "",
          fullName: "",
          nominatenPassword: "",
          password: "",
          email: "",
      },
    };
    },
    
  },
};
</script>