export default class Request {
  static handleErrors(response) {
    if (!response.ok) {
      throw Error(response.data);
    }
    return response;
  }

  static async get(url, json = true) {
    const options = {
      method: "GET",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
      },
    };
    try {
      const response = await fetch(url, options);
      return json ? await response.json() : response;
    } catch (err) {
      console.log("Error getting documents", err);
    }
  }

  static async post(url, data, success, errorHandler) {
    const options = {
      method: "POST",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(data),
    };
    try {
      return await fetch(url, options).then((response) => response.json());
    } catch (err) {
      console.log("Error getting documents", err);
    }
  }

  static async put(url, data, success, errorHandler) {
    const options = {
      method: "PUT",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(data),
    };
    try {
      return await fetch(url, options).then((response) => response.json());
    } catch (err) {
      console.log("Error getting documents", err);
    }
  }

  static async postFormData(url, data, success, errorHandler) {
    const options = {
      method: "POST",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        Accept: "application/json",
        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]')
          .content,
      },
      body: data,
    };
    try {
      return await fetch(url, options).then((response) => response.json());
    } catch (err) {
      console.log("Error getting documents", err);
    }
  }

  static async getPDF(url) {
    const options = {
      method: "GET",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/pdf",
      },
    };
    try {
      return await fetch(url, options).then((r) => r.blob());
    } catch (err) {
      console.log("Error getting documents", err);
    }
  }

  static async postWithToken(url, data) {
    if (!(data instanceof FormData)) {
      data["_token"] = document.head.querySelector(
        'meta[name="csrf-token"]'
      ).content;
      return await this.post(url, data);
    }
    return await this.postFormData(url, data);
  }

  static async putWithToken(url, data) {
    if (!(data instanceof FormData)) {
      data["_token"] = document.head.querySelector(
        'meta[name="csrf-token"]'
      ).content;
      return await this.put(url, data);
    }
    return await this.postFormData(url, data);
  }

  static async delete(url, data, success, errorHandler) {
    const options = {
      method: "DELETE",
      headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(data),
    };
    try {
      return await fetch(url, options).then((response) => response.json());
    } catch (err) {
      console.log("Error getting documents", err);
    }
  }

  static async deleteWithToken(url) {
    const data = {
      _token: document.head.querySelector('meta[name="csrf-token"]').content,
    };
    return await this.delete(url, data);
  }

  static getUrlParam(name) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if (urlParams.has(name)) {
      return urlParams.get(name);
    }
    return "";
  }
}
