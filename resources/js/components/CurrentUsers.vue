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

var socket = io('redis://h:p51cfbbe766cb076f687941b197b9d95a81ab67c9daf49845ffba9f22ad3ea8d3@ec2-99-81-167-43.eu-west-1.compute.amazonaws.com:6639');

export default {

    data() {
        return {
            currentUsers: [],
        }
    },

    created() {

        socket.on('user-entered-chat-channel:App\\Events\\UserEnteredChat', function(data) {
            console.log('amazon connect');
            this.currentUsers.unshift(data.userIdentifiers);
        }.bind(this));
    },
}
</script>
