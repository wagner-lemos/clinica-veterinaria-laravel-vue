import { ref } from "vue";

export const useUserStore = defineStore("userStore", {
  state() {
    const token = ref(null);
    const user = ref(null);
    const isLoggedIn = ref(false);

    return {
      token,
      user,
      isLoggedIn,
    };
  },
  actions: {
    updateStateFromLocalStorage() {
      const tokenValue = localStorage.getItem("token");
      const userValue = JSON.parse(localStorage.getItem("user"));
      const isLoggedInValue = JSON.parse(localStorage.getItem("is_logged"));

      tokenValue ? this.token = tokenValue : this.token = null
      userValue ? this.user = userValue : this.user = null
      isLoggedInValue ? this.isLoggedIn = isLoggedInValue : this.isLoggedIn = null
    },

    setToken(tokenValue) {
      localStorage.setItem("token", tokenValue);
      this.token = tokenValue;
    },

    setUser(userValue) {
      localStorage.setItem("user", JSON.stringify(userValue));
      this.user = userValue;
    },

    setIsLogged(isLoggedInValue) {
      localStorage.setItem("is_logged", JSON.stringify(isLoggedInValue));
      this.isLoggedIn = isLoggedInValue;
    },

    clear() {
      localStorage.removeItem("token");
      localStorage.removeItem("user");
      localStorage.removeItem("is_logged");
      this.token = "";
      this.user = "";
      this.isLoggedIn = false;
    },
  },
});

