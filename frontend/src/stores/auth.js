import { defineStore } from 'pinia'
import router from '@/router'
import { loginUser } from '@/api/userService'

export const useAuthStore = defineStore('auth', {
	state: () => ({ token: localStorage.getItem('token') || '' }),
	getters: { isLogged: state => Boolean(state.token) },
	actions: {
		async login(token) {
			this.token = token
			localStorage.setItem('token', token)
			router.push('/')
		},
		logout() {
			this.token = ''
			localStorage.removeItem('token')
			router.push('/login')
		}
	}
})