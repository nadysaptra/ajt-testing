<template>
  <Head>
    <title>{{ $page.props.title }}</title>
  </Head>

  <!-- TOP BAR -->
  <nav class="flex items-center justify-between flex-wrap bg-red-500">
    <div class="lg:ml-48 lg:mr-4">
      <img src="/assets/maukerja-logo.png" />
    </div>
    <div class="block lg:hidden">
      <button
        @click="showBtnMobile"
        class="flex items-center px-3 py-2 border rounded text-neutral-700 border-teal-400 hover:text-white hover:border-white mr-4"
      >
        <svg
          class="fill-current h-3 w-3"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <title>Menu</title>
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
        </svg>
      </button>
    </div>
    <!-- desktop menu -->
    <div
      class="w-full hidden lg:block flex-grow lg:flex lg:items-center lg:w-auto lg:mr-48"
    >
      <div class="text-sm lg:flex-grow p-6">
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          All Jobs
        </a>
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          Tools
        </a>
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          Help
        </a>
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          Blog
        </a>
      </div>
    </div>
    <!-- mobile menu -->
    <div
      v-if="showMobileMenu"
      class="w-full block flex-grow lg:flex lg:items-center lg:w-auto lg:mr-48"
    >
      <div class="text-sm lg:flex-grow p-6">
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          All Jobs
        </a>
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          Tools
        </a>
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          Help
        </a>
        <a
          :href="route('homepage')"
          class="block lg:inline-block lg:mt-0 text-neutral-700 lg:text-white md:text-white mx-2 px-6 p-2 rounded-md mb-2"
        >
          Blog
        </a>
      </div>
    </div>
  </nav>

  <!-- FILTER -->
  <nav class="flex items-center justify-between flex-wrap bg-white">
    <div
      class="lg:mx-48 w-full block flex-grow lg:flex lg:items-center lg:w-auto p-3"
    >
      <form class="w-full" @submit.prevent="submit">
        <div class="lg:flex md:flex -mx-3">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <input
              v-model="form.job"
              class="appearance-none block w-full bg-slate-50 text-gray-700 border border-gray-300 rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="job"
              type="text"
              placeholder="Job title, company"
            />
          </div>
          <div class="w-full md:w-1/2 px-3">
            <input
              v-model="form.location"
              class="appearance-none block w-full bg-slate-50 text-gray-700 border border-gray-300 rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              id="location"
              type="text"
              placeholder="Location"
            />
          </div>
          <div class="w-full md:w-1/2 px-3">
            <div class="relative">
              <select
                class="appearance-none block w-full bg-slate-50 text-gray-700 border border-gray-300 rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="salary"
                placeholder="Min Salary (MYR)"
                v-model="form.salary"
              >
                <option value="0" selected disabled>Min Salary (MYR)</option>
                <option value="0">Any Range</option>
                <template v-for="(item, index) in salary_range" :key="index">
                  <option :value="item.value">{{ item.text }}</option>
                </template>
              </select>
              <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
              >
                <svg
                  class="fill-current h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                  />
                </svg>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <div class="relative">
              <button
                class="flex p-3 rounded-full text-white px-8"
                v-bind:class="{
                  'bg-gray-500': loading,
                  'bg-red-500': !loading
                }"
                type="submit"
              >
                <svg
                  class="fill-white mr-2"
                  width="24"
                  height="24"
                  xmlns="http://www.w3.org/2000/svg"
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                >
                  <path
                    d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z"
                  />
                </svg>
                {{ loading ? "Loading . . ." : "Find Job" }}
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </nav>
  <!-- CONTENT -->
  <div class="lg:mx-96 lg:mt-6">
    <div class="flex items-center justify-between flex-wrap">
      <!-- CARD -->
      <template v-for="item in jobs.data" :key="item.id">
        <div class="w-full rounded-lg overflow-hidden shadow-lg bg-white mb-6">
          <div class="px-6 py-4">
            <div class="text-xl mb-2 flex">
              <img class="w-28" src="/assets/watsons-logo.png" />
              <div class="flex items-left content-center flex-col">
                <p class="text-sm">&nbsp;</p>
                <h1 class="font-bold">
                  <a :href="route('jobs.detail', item.id)">{{ item.title }}</a>
                </h1>
                <p class="text-sm">{{ item.company.name }}</p>
              </div>
            </div>
          </div>
          <div class="px-6 pt-4 pb-2">
            <div class="flex">
              <div class="flex w-96">
                <svg
                  class="mr-2"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M22 7h-19v11h-1v-12h20v1zm-2-2h-19v11h-1v-12h20v1zm-6 6c-1.656 0-3 1.344-3 3s1.344 3 3 3 3-1.344 3-3-1.344-3-3-3zm.15 4.484v.315h-.3v-.299c-.311-.005-.632-.079-.898-.217l.135-.493c.287.11.669.229.968.162.345-.078.415-.433.034-.604-.279-.129-1.133-.242-1.133-.973 0-.409.312-.775.895-.855v-.319h.301v.305c.217.006.461.043.732.126l-.108.493c-.23-.08-.485-.154-.733-.139-.446.026-.486.413-.174.575.514.242 1.182.42 1.182 1.063 0 .516-.404.791-.901.86zm-10.15-7.484v12h20v-12h-20zm18 8.018c-.959.42-1.395 1.022-1.814 1.982h-12.372c-.419-.959-.855-1.562-1.814-1.982v-4.036c.959-.42 1.395-1.022 1.814-1.982h12.371c.42.959.855 1.562 1.814 1.982v4.036z"
                  />
                </svg>
                <p>
                  {{ item.salary.currency }} {{ item.salary.min }} -
                  {{ item.salary.currency }} {{ item.salary.max }}
                </p>
              </div>
              <div class="flex w-96">
                <svg
                  class="mr-2"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 14h-7v-8h2v6h5v2z"
                  />
                </svg>
                <p>{{ item.job_type }}</p>
              </div>
            </div>
            <div class="flex mt-2">
              <div class="flex">
                <svg
                  class="mr-2"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                >
                  <path
                    d="M12 0c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602zm0 11c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3z"
                  />
                </svg>
                <p>{{ item.location.state }}</p>
              </div>
            </div>
          </div>
          <div class="px-6 pt-4 pb-2">
            <p class="text-gray-400 truncate">
              {{ item.descriptions.requirements }}
            </p>
          </div>
          <hr />
          <div class="flex p-6">
            <div
              class="w-1/2 p-2 text-center justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4"
            >
              <svg
                class="mr-2"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
              >
                <path
                  d="M12 4.248c-3.148-5.402-12-3.825-12 2.944 0 4.661 5.571 9.427 12 15.808 6.43-6.381 12-11.147 12-15.808 0-6.792-8.875-8.306-12-2.944z"
                />
              </svg>
              <p>Save</p>
            </div>
            <div
              class="w-1/2 p-2 text-center justify-center items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4"
            >
              <svg
                class="mr-2"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
              >
                <path
                  d="M12.23 15.5c-6.801 0-10.367-1.221-12.23-2.597v9.097h24v-8.949c-3.218 2.221-9.422 2.449-11.77 2.449zm1.77 2.532c0 1.087-.896 1.968-2 1.968s-2-.881-2-1.968v-1.032h4v1.032zm-14-8.541v-2.491h24v2.605c0 5.289-24 5.133-24-.114zm9-7.491c-1.104 0-2 .896-2 2v2h2v-1.5c0-.276.224-.5.5-.5h5c.276 0 .5.224.5.5v1.5h2v-2c0-1.104-.896-2-2-2h-6z"
                />
              </svg>
              <p>Apply</p>
            </div>
          </div>
        </div>
      </template>
      <template v-if="jobs.data && jobs.data.length == 0">
        <p class="bg-red-700 p-6 rounded-md text-white w-full">No Data</p>
      </template>
    </div>
  </div>
</template>

<script>
import { reactive } from "vue";
import * as axios from "axios";

export default {
  data() {
    let loading = false;
    let jobs = {};
    let showMobileMenu = false;
    const salary_range = [
      {
        value: "0-1000",
        text: "< 1000"
      },
      {
        value: "1001-2000",
        text: "RM 1001 - RM 2000"
      },
      {
        value: "2001-3000",
        text: "RM 2001 - RM 3000"
      },
      {
        value: "3001-99999",
        text: "> RM 3000"
      }
    ];
    const form = reactive({
      job: null,
      location: null,
      salary: 0
    });

    function submit() {
      let filter = "";
      if (form["job"]) {
        filter += `&filter[title]=${form["job"]}`;
      }
      if (form["location"]) {
        filter += `&filter[state]=${form["location"]}`;
      }
      if (form["salary"] && form["salary"] != 0) {
        const [salary_min, salary_max] = form["salary"].split("-");
        filter += `&filter[salary_min]=${salary_min}&filter[salary_max]=${salary_max}`;
      }
      this.getData(filter);
    }

    function getData(filter = "") {
      this.loading = true;
      axios
        .get("https://feapi.ajt.my/jobs?" + filter)
        .then((res) => {
          this.jobs = res.data;
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
          this.jobs.data = [];
        });
    }

    function populateFilter() {
      console.log("route().params", route().params);
      const param = route().params;
      if ("filter" in param) {
        if ("salary_min" in param["filter"] && "salary_max" in param["filter"])
          this.form.salary = `${param["filter"]["salary_min"]}-${param["filter"]["salary_max"]}`;
        if ("title" in param["filter"]) {
          this.form.job = param["filter"]["title"];
        }
        if ("location" in param["filter"]) {
          this.form.location = param["filter"]["location"];
        }
      }
    }

    function showBtnMobile() {
      this.showMobileMenu = !this.showMobileMenu;
    }

    return {
      populateFilter,
      salary_range,
      jobs,
      form,
      submit,
      getData,
      loading,
      showBtnMobile,
      showMobileMenu
    };
  },
  mounted() {
    this.populateFilter();
    this.getData();
  }
};
</script>
