<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

// Vue Router ব্যবহার করার জন্য
const router = useRouter();

// ফর্মের ডেটা মডেল
const email = ref(null); // null দিয়ে শুরু করা
const password = ref(null);
const rememberMe = ref(false);

// লগইন হ্যান্ডলার ফাংশন
const handleLogin = () => {
    // *** এখানে আপনার আসল API কল এবং প্রমাণীকরণ লজিক যুক্ত হবে ***

    // ডামি লগইন চেক (টেস্ট করার জন্য)
    if (email.value === 'azmira@gmail.com' && password.value === '123456') {

        // লগইন সফল হলে, প্রমাণীকরণের জন্য একটি ফ্ল্যাগ লোকাল স্টোরেজে সেট করুন
        localStorage.setItem('user_logged_in', 'true');

        // *** মূল সংশোধন: আপনার index.js এ /dashboard রুটটি নেই, তাই /roles এ রিডিরেক্ট করা হলো ***
        router.push('/roles');

    } else {
        alert('Invalid Email or Password. Please try again.');
    }
};
</script>

<template>
    <main class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <router-link to="/"><b>Admin</b>LTE</router-link>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form @submit.prevent="handleLogin">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" v-model="email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" v-model="password"
                                required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" v-model="rememberMe">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>

                    <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div>
                    <p class="mb-1">
                        <router-link to="/forgot-password">I forgot my password</router-link>
                    </p>
                    <p class="mb-0">
                        <router-link to="/register" class="text-center">Register a new membership</router-link>
                    </p>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>
/* লগইন পেজকে ফুল-স্ক্রিন করার জন্য CSS */
.login-page {
    /* এটি নিশ্চিত করবে যে লগইন ফর্মটি পুরো স্ক্রিন জুড়ে প্রদর্শিত হচ্ছে */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f6f9;
    /* AdminLTE login page background */
    width: 100%;
}

.login-box {
    width: 360px;
}

/* যদি আপনার ড্যাশবোর্ড কন্টেইনারে মার্জিন থাকে, তবে এটিকে রিসেট করতে হতে পারে */
.container {
    width: 100%;
    margin: 0;
    padding: 0;
}
</style>