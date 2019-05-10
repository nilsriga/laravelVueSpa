<template>
    <div>
        <p>Currently Connected:</p>
        <div v-for="userIdentifiers in currentUsers" :key="userIdentifiers.id">
            <ul v-if="userIdentifiers.device != 0">
                <li>A user on {{userIdentifiers.device}} using {{userIdentifiers.browser}} browser has connected</li>
            </ul>
            <ul v-else>
                <li>A user on {{userIdentifiers.os}} using {{userIdentifiers.browser}} browser has connected</li>
            </ul>
        </div> 
    </div>
</template>

<script>

var socket = io('http://192.168.10.10:3000');

export default {

    data() {
        return {
            currentUsers: [],
        }
    },

    created() {

        socket.on('user-entered-chat-channel:App\\Events\\UserEnteredChat', function(data) {
            this.currentUsers.unshift(data.userIdentifiers);
        }.bind(this));
    },
}
</script>
