<template>
	
	<tr>
      <td v-text="row.id"></td>
      <td v-text="row.name"></td>
      <td v-text="row.created_at"></td>
      <td><a @click.prevent="toggleModal(row)" href="#">Open Modal</a></td>
    </tr>


</template>


<script>
	export default {
		props: ['row'],
	    methods: {
	    	toggleModal(row) {
	      		Event.$emit('toggleModal', row);
	    	}
	  	}
	}


</script>