<template>
    <div class="wrap">
            <a class="dropdown-item unread waves-effect waves-light" @click="markNotificationAsRead">
                <div class="row">
                    <div class="col-3 text-center">
                        <img v-if="unread.data.avatar == ''" :src="joke.avatar" class="img-fluid rounded-circle z-depth-1" style="height:30px;width:30px;object-fit: cover;" alt="">
                        <img v-else :src="user_avatar" class="img-fluid rounded-circle z-depth-1" style="height:30px;width:30px;object-fit: cover;" alt="">
                    </div>
                    <div class="col-8 pl-0 pr-0">
                        <div class="row justify-content-between">
                        <strong>{{ unread.data.user_name }}</strong>
                            {{ somedate }}
                        </div>
                        <div class="row">
                            {{ unread.data.message.substr(0,40) }}
                        </div>
                    </div>
                </div>
            </a>
    </div>
</template>

<script>
moment().format();
    export default {
        props:['unread'],
        data(){
            return {
                threadUrl:"",
                somedate: moment(this.unread.created_at).fromNow(),
                joke: {
                    avatar: 'https://ccslms.online/images/profile_pic.png'
                },
                user_avatar: 'https://ccslms.online/storage/app/public/avatars/' + this.unread.data.avatar,
                getmessagesurl2: window.location.pathname,
                test2: '',
                etoyun2: '',
                instruc2: '',
                etoyunsainstruc2: ''
            }
        },
        methods: {
            markNotificationAsRead() {
                axios.get('/markAsRead', {
                    params: {
                        id: this.unread.id
                    }
                }).then((response) => {
                    console.log(response);
                    var hiwalay2 = this.getmessagesurl2.split('/');
                    this.instruc2 = hiwalay2.slice(1,2).join();

                    if(this.instruc2 == 'instructor'){
                        this.etoyunsainstruc2 = hiwalay2.slice(4,5).join();
                        var getfour2 = hiwalay2.slice(0,4).join('/');
                        this.test2 = getfour2 + "/";

                        if(this.etoyunsainstruc2 == 'announcements'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'announcement'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'tokens'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'token'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'assignments'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'assignment'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'quizzes'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'quiz'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"zes/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'lessons'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'lesson'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'sections'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyunsainstruc2 == 'section'){
                            window.location.href = this.test2+this.etoyunsainstruc2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else {
                            window.location.href = "/messages/convo/"+this.unread.data.convo_id;
                        }

                    } else if(this.instruc2 == 'student') {
                        this.etoyun2 = hiwalay2.slice(6,7).join();
                        var getsix2 = hiwalay2.slice(0,6).join('/');
                        this.test2 = getsix2 + "/";

                        if(this.etoyun2 == 'lesson'){
                            window.location.href = this.test2+this.etoyun2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'lessons'){
                            window.location.href = this.test2+this.etoyun2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'announcements'){
                            window.location.href = this.test2+this.etoyun2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'assignments'){
                            window.location.href = this.test2+this.etoyun2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'assignment'){
                            window.location.href = this.test2+this.etoyun2+"s/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'quiz'){
                            window.location.href = this.test2+this.etoyun2+"zes/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'quizzes'){
                            window.location.href = this.test2+this.etoyun2+"/messages/convo/"+this.unread.data.convo_id;
                        } else if(this.etoyun2 == 'mysection'){
                            window.location.href = this.test2+this.etoyun2+"/messages/convo/"+this.unread.data.convo_id;
                        } else {
                            window.location.href = "/messages/convo/"+this.unread.data.convo_id;
                        }
                    } else {
                        window.location.href = "/messages/convo/"+this.unread.data.convo_id;
                    }
                });
            }
        }
    }
</script>