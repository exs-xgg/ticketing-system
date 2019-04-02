<template>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope"></i> 
                    <span v-if="unreadNotifications.length > 0" class="badge badge-danger">{{ unreadNotifications.length }}</span>
            </a>
            <div v-if="unreadNotifications.length > 5" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="width:358px !important;right:-74px; height:500px;overflow-y:scroll">
                <a v-if="unreadNotifications.length > 0" class="dropdown-item" @click="markAsAllRead">Mark as All Read</a>
                <notification-item v-for="unread in unreadNotifications" :unread="unread" :key="unread.id"></notification-item>
                <a class="dropdown-item" @click="seeall">See All</a>
            </div>
            <div v-else class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="width:358px !important;right:-74px; height:auto;overflow-y:hidden">
                <a v-if="unreadNotifications.length > 0" class="dropdown-item" @click="markAsAllRead">Mark as All Read</a>
                <notification-item v-for="unread in unreadNotifications" :unread="unread" :key="unread.id"></notification-item>
                <a class="dropdown-item" @click="seeall">See All</a>
            </div>
        </li>
</template>

<script>
    import NotificationItem from './NotificationItem.vue';
    export default {
        props: ['unreads', 'userid'],
        components: {NotificationItem},
        data(){
            return {
                unreadNotifications: this.unreads,
                getmessagesurl: window.location.pathname,
                test: '',
                etoyun: '',
                instruc: '',
                etoyunsainstruc: ''
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);

                    let newUnreadNotifications = {
                        id:notification.id,
                        data: {
                            user: notification.user_id,
                            convo_id: notification.convo_id,
                            message: notification.message,
                            link: notification.link, 
                            user_name: notification.user_name, 
                            avatar: notification.avatar, 
                        }
                    };
                    this.unreadNotifications.unshift(newUnreadNotifications);
                });
        },
        methods: {
            markAsAllRead() {
                window.location.href = "/markAsAllRead";
            },
            seeall() {
                var hiwalay = this.getmessagesurl.split('/');
                this.instruc = hiwalay.slice(1,2).join();
                
                if(this.instruc == 'instructor'){
                    this.etoyunsainstruc = hiwalay.slice(4,5).join();
                    var getfour = hiwalay.slice(0,4).join('/');
                    this.test = getfour + "/";

                    if(this.etoyunsainstruc == 'announcements'){
                        window.location.href = this.test+this.etoyunsainstruc+"/messages";
                    } else if(this.etoyunsainstruc == 'announcement'){
                        window.location.href = this.test+this.etoyunsainstruc+"s/messages";
                    } else if(this.etoyunsainstruc == 'tokens'){
                        window.location.href = this.test+this.etoyunsainstruc+"/messages";
                    } else if(this.etoyunsainstruc == 'token'){
                        window.location.href = this.test+this.etoyunsainstruc+"s/messages";
                    } else if(this.etoyunsainstruc == 'assignments'){
                        window.location.href = this.test+this.etoyunsainstruc+"/messages";
                    } else if(this.etoyunsainstruc == 'assignment'){
                        window.location.href = this.test+this.etoyunsainstruc+"s/messages";
                    } else if(this.etoyunsainstruc == 'quizzes'){
                        window.location.href = this.test+this.etoyunsainstruc+"/messages";
                    } else if(this.etoyunsainstruc == 'quiz'){
                        window.location.href = this.test+this.etoyunsainstruc+"zes/messages";
                    } else if(this.etoyunsainstruc == 'lessons'){
                        window.location.href = this.test+this.etoyunsainstruc+"/messages";
                    } else if(this.etoyunsainstruc == 'lesson'){
                        window.location.href = this.test+this.etoyunsainstruc+"s/messages";
                    } else if(this.etoyunsainstruc == 'sections'){
                        window.location.href = this.test+this.etoyunsainstruc+"/messages";
                    } else if(this.etoyunsainstruc == 'section'){
                        window.location.href = this.test+this.etoyunsainstruc+"s/messages";
                    } else {
                        window.location.href = "/messages";
                    }

                } else if(this.instruc == 'student') {
                    this.etoyun = hiwalay.slice(6,7).join();
                    var getsix = hiwalay.slice(0,6).join('/');
                    this.test = getsix + "/";

                    if(this.etoyun == 'lesson'){
                        window.location.href = this.test+this.etoyun+"s/messages";
                    } else if(this.etoyun == 'lessons'){
                        window.location.href = this.test+this.etoyun+"/messages";
                    } else if(this.etoyun == 'announcements'){
                        window.location.href = this.test+this.etoyun+"/messages";
                    } else if(this.etoyun == 'assignments'){
                        window.location.href = this.test+this.etoyun+"/messages";
                    } else if(this.etoyun == 'assignment'){
                        window.location.href = this.test+this.etoyun+"s/messages";
                    } else if(this.etoyun == 'quiz'){
                        window.location.href = this.test+this.etoyun+"zes/messages";
                    } else if(this.etoyun == 'quizzes'){
                        window.location.href = this.test+this.etoyun+"/messages";
                    } else if(this.etoyun == 'mysection'){
                        window.location.href = this.test+this.etoyun+"/messages";
                    } else {
                        window.location.href = "/messages";
                    }
                } else {
                    window.location.href = "/messages";
                }
            }
        }
    }
</script>
