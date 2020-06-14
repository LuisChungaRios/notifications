<template>
  <div >
      <h3> You have <small class="text-danger"> {{countNotifications}} </small>  notifications</h3>


      <ul class="list-group">
          <li class="list-group-item" v-for="notification in notifications" :key="notification.id">
              <a :href="notification.data.link">  {{notification.data.text}} </a>
          </li>
      </ul>

      <pre> {{notifications}} </pre>
  </div>
</template>

<script>
  export default {

      props: {
        uriEventSource: {
            required: true,
            type: String
        }
      },
    data() {
        return {
            notifications: []
        }
    },
      created() {
        this.setEventSource();
      },
      methods: {
        setEventSource() {
            let event = new  EventSource( this.uriEventSource);

              event.addEventListener('message' ,  e => {
                  this.notifications = JSON.parse(e.data)
                  console.log(this.notifications.length)
              })

              event.document.addEventListener('error',  e => {
                  console.error(e)
              })


        }
    },
      computed: {
          countNotifications()
          {
              return this.notifications.length
          }
      }
  }
</script>

<style scoped>

</style>
