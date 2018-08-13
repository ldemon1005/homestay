<template>
    <div id="header">
        <section class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-12 header-container">
                        <figure class="logo" v-bind:style="headerImageStyle"></figure>
                        <figure class="magnifying-glass">
                            <i class="fas fa-search"></i>
                        </figure>
                        <ul class="auth-button">
                            <li>Đăng nhập</li>
                            <li>Đăng ký</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="header-bot">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ul>
                            <li>ĐIỂM ĐẾN</li>
                            <li>HOMESTAY</li>
                            <li>BLOG</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                headerImageStyle: {
                    'background-image': 'url(./../storage/app/guest/header-footer/image/logo-ngang-black.png)'
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>

<style scoped>
#id{
    width: 100%;
    max-width: 1440px;
    position: relative;
}
.header-top{
    border-bottom: 1px solid #ccc;
}
.logo{
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    height: 130px;
    width: 180px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}
.header-container{
    height: 162px;
    position: relative;
}
.auth-button{
    font-family: 'Muli', sans-serif;
    font-weight: 700;
    font-size: 14px;
    position: absolute;
    top: 65px;
    right: 0;
}
.auth-button>li{
    display: inline-block;
    margin:20px;
}
.magnifying-glass{
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
}
.header-bot{
    height: 100px;
}
</style>