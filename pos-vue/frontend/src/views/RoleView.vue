<template>
    <div>
        <!-- Header -->
        <MainHead />

        <div class="flex">
            <!-- Sidebar -->
            <AsideBar />

            <!-- Main Content -->
            <div class="flex-1 p-4">
                <!-- Route components will render here -->
                <router-view></router-view>
            </div>
        </div>

        <!-- Footer -->
        <MainFoot />
    </div>
</template>

<script>
import AsideBar from '@/components/layouts/AsideBar.vue';
import MainHead from '@/components/layouts/MainHead.vue';
import MainFoot from '@/components/layouts/MainFoot.vue';

export default {
    components: {
        AsideBar,
        MainHead,
        MainFoot
    }
}
</script>