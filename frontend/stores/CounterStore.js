import { ref } from 'vue'

export const useCounterStore = defineStore('counter', {
    //state
    state() {
        const count = ref(0)
        return {
            count
        }
    },

    //actions
    actions: {
        increment() {
            this.count++
        },
        decrement() {
            this.count--
        },
        reset() {
            this.count = 0
        }
    },

    // getters
    getters: {
        showCount() {
            return 'O valor do count é: ' + this.count
        }
    }
})