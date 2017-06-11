/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var AddDayButton = function (_React$Component) {
    _inherits(AddDayButton, _React$Component);

    function AddDayButton(props) {
        _classCallCheck(this, AddDayButton);

        return _possibleConstructorReturn(this, (AddDayButton.__proto__ || Object.getPrototypeOf(AddDayButton)).call(this, props));
    }

    _createClass(AddDayButton, [{
        key: "render",
        value: function render() {
            return React.createElement(
                "div",
                { className: "add-day-button-wrapper" },
                React.createElement(
                    "a",
                    { key: "add-day-button", onClick: this.props.onclick, className: "button button-primary button-large", href: "#" },
                    "Add Day"
                )
            );
        }
    }]);

    return AddDayButton;
}(React.Component);

exports.default = AddDayButton;

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _addday = __webpack_require__(0);

var _addday2 = _interopRequireDefault(_addday);

var _daylist = __webpack_require__(2);

var _daylist2 = _interopRequireDefault(_daylist);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var element = React.createElement;

var TourMetaBoxWrapper = function (_React$Component) {
    _inherits(TourMetaBoxWrapper, _React$Component);

    function TourMetaBoxWrapper(props) {
        _classCallCheck(this, TourMetaBoxWrapper);

        var _this = _possibleConstructorReturn(this, (TourMetaBoxWrapper.__proto__ || Object.getPrototypeOf(TourMetaBoxWrapper)).call(this, props));

        _this.state = {
            tourId: lptlusTourId.TourId,
            activities: [],
            selectedAct: [],
            dayList: []
        };
        _this.addDay = _this.addDay.bind(_this);
        _this.handleSelectActivity = _this.handleSelectActivity.bind(_this);
        _this.handleDayDelete = _this.handleDayDelete.bind(_this);
        _this.nextId = _this.nextId.bind(_this);
        return _this;
    }

    _createClass(TourMetaBoxWrapper, [{
        key: 'addDay',
        value: function addDay(e) {
            e.preventDefault();
            var nextIdValue = this.nextId();
            this.setState({
                total: this.state.dayList.push({
                    id: '',
                    title: {
                        rendered: 'Day' + nextIdValue
                    },
                    content: {
                        rendered: 'teste'
                    }
                })
            });
        }
    }, {
        key: 'handleSelectActivity',
        value: function handleSelectActivity(e) {
            var dayID = e.target.name;
            var actID = e.target.id;
            var checked = e.target.checked;
            if (checked) {
                this.setState(function (prevState, nextProps) {
                    var selected = prevState.activities.find(function (act) {
                        return act.id == actID;
                    });
                    prevState.selectedAct.push({ dayID: dayID, act: selected });

                    return {
                        activities: prevState.activities.filter(function (act) {
                            return act.id != actID;
                        }),
                        selectedAct: prevState.selectedAct
                    };
                });
            }
        }
    }, {
        key: 'handleDayDelete',
        value: function handleDayDelete(e) {
            e.preventDefault();

            var dayID = e.target.id;

            this.serverRequest = jQuery.ajax({
                url: lptlusWpApiSettings.root + 'wp/v2/days/' + dayID,
                method: 'DELETE',
                beforeSend: function beforeSend(xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', lptlusWpApiSettings.nonce);
                }
            }).done(function (result) {});
        }
    }, {
        key: 'nextId',
        value: function nextId() {
            return this.state.dayList.length + 1;
        }
    }, {
        key: 'componentDidMount',
        value: function componentDidMount() {
            this.serverRequest = jQuery.get('http://localhost/wp-loveptlikeus.com/wp-json/wp/v2/resources?res_type=5&region=9', function (result) {
                var acts = [].concat(_toConsumableArray(result));
                // const handleSelectActivity = this.handleSelectActivity;
                this.setState({
                    // activities: acts.map(function(act) {
                    //     return (element('input', {key: act.id, id: act.id, title: act.title.rendered, type: "checkbox", util: handleSelectActivity}, null))
                    // })
                    activities: acts
                });
            }.bind(this));

            this.serverRequest = jQuery.get('http://localhost/wp-loveptlikeus.com/wp-json/wp/v2/days?parent=' + this.state.tourId, function (result) {
                var days = [].concat(_toConsumableArray(result));
                // const handleDayDelete = this.handleDayDelete;
                // var activities = this.state.activities;
                // var selectedAct = this.state.selectedAct;
                this.setState({
                    // dayList: posts.map(function(post) {
                    //     return (element(DayItem, {
                    //         key: post.id, 
                    //         id: post.id, 
                    //         title: post.title.rendered, 
                    //         text: post.content.rendered, 
                    //         del: handleDayDelete, 
                    //         activities: activities,
                    //         selectedAct: selectedAct
                    //     }, null))
                    // })
                    dayList: days
                });
            }.bind(this));
        }
    }, {
        key: 'render',
        value: function render() {
            return element('div', { className: "tourmetabox-inner" }, [element(_daylist2.default, {
                key: "day-list",
                activities: this.state.activities,
                selectedAct: this.state.selectedAct,
                dayList: this.state.dayList,
                handleDayDelete: this.handleDayDelete,
                handleSelectActivity: this.handleSelectActivity
            }, null), React.createElement(_addday2.default, { key: 'add-day-button', onclick: this.addDay })]);
        }
    }]);

    return TourMetaBoxWrapper;
}(React.Component);

ReactDOM.render(element(TourMetaBoxWrapper, null, null), document.getElementById('tourMetaBox'));

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _dayitem = __webpack_require__(3);

var _dayitem2 = _interopRequireDefault(_dayitem);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var element = React.createElement;

var DayList = function (_React$Component) {
    _inherits(DayList, _React$Component);

    function DayList(props) {
        _classCallCheck(this, DayList);

        var _this = _possibleConstructorReturn(this, (DayList.__proto__ || Object.getPrototypeOf(DayList)).call(this, props));

        _this.state = {
            dayList: _this.props.dayList,
            activities: _this.props.activities,
            selectedAct: _this.props.selectedAct
        };
        _this.getDayItemList = _this.getDayItemList.bind(_this);
        return _this;
    }

    _createClass(DayList, [{
        key: 'componentWillReceiveProps',
        value: function componentWillReceiveProps(nextProps) {
            this.setState({
                activities: nextProps.activities,
                selectedAct: nextProps.selectedAct,
                dayList: nextProps.dayList
            });
        }
    }, {
        key: 'getDayItemList',
        value: function getDayItemList() {
            var dayItemList = this.state.dayList.map(function (day) {
                return React.createElement(_dayitem2.default, {
                    key: day.id,
                    id: day.id,
                    title: day.title.rendered,
                    content: day.content.rendered,
                    handleDayDelete: this.props.handleDayDelete,
                    handleSelectActivity: this.props.handleSelectActivity,
                    activities: this.state.activities,
                    selectedAct: this.state.selectedAct
                });
            }.bind(this));

            return dayItemList;
        }
    }, {
        key: 'render',
        value: function render() {
            return element('div', { className: "tour-day-item-wrapper" }, this.getDayItemList());
        }
    }]);

    return DayList;
}(React.Component);

exports.default = DayList;

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _actlist = __webpack_require__(4);

var _actlist2 = _interopRequireDefault(_actlist);

var _deldaybutton = __webpack_require__(5);

var _deldaybutton2 = _interopRequireDefault(_deldaybutton);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var element = React.createElement;

var DayItem = function (_React$Component) {
    _inherits(DayItem, _React$Component);

    function DayItem(props) {
        _classCallCheck(this, DayItem);

        var _this = _possibleConstructorReturn(this, (DayItem.__proto__ || Object.getPrototypeOf(DayItem)).call(this, props));

        _this.state = {
            id: _this.props.id,
            title: _this.props.title,
            content: _this.props.content,
            activities: _this.props.activities,
            selectedAct: _this.props.selectedAct
        };
        _this.handleInputChange = _this.handleInputChange.bind(_this);
        _this.handleDaySubmit = _this.handleDaySubmit.bind(_this);
        return _this;
    }

    _createClass(DayItem, [{
        key: 'componentWillReceiveProps',
        value: function componentWillReceiveProps(nextProps) {
            this.setState({
                id: nextProps.id,
                title: nextProps.title,
                content: nextProps.content,
                activities: nextProps.activities,
                selectedAct: nextProps.selectedAct
            });
        }
    }, {
        key: 'handleInputChange',
        value: function handleInputChange(e) {
            var target = e.target;
            var value = target.value;
            var name = target.name;

            this.setState(_defineProperty({}, name, value));
        }
    }, {
        key: 'handleDaySubmit',
        value: function handleDaySubmit(e) {
            e.preventDefault();
            this.serverRequest = jQuery.ajax({
                url: lptlusWpApiSettings.root + 'wp/v2/days/' + this.state.id,
                method: 'POST',
                beforeSend: function beforeSend(xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', lptlusWpApiSettings.nonce);
                },
                data: {
                    "title": this.state.title,
                    "content": this.state.text,
                    "status": "publish",
                    "parent": this.state.parent
                }
            }).done(function (result) {
                this.setState({
                    id: result.id
                });
            }.bind(this));
        }
    }, {
        key: 'render',
        value: function render() {
            return element('div', { key: this.state.id, className: "tour-day-item" }, [element('form', { key: "form" + this.state.id, onSubmit: this.handleDaySubmit }, [element('label', { key: "label-title" + this.state.id, name: "title" }, [element('input', {
                key: "input-title" + this.state.id,
                name: "title",
                onChange: this.handleInputChange,
                value: this.state.title
            }, null)], 'Title:'), element('label', { key: "label-text" + this.state.id }, [element('textarea', {
                key: "input-text" + this.state.id,
                name: "text",
                onChange: this.handleInputChange,
                value: this.state.content
            }, null)], 'Text:'),
            // element(ActList, {key: 'activities-wrapper' + this.state.id, activities: this.state.activities, dayID: this.state.id, selectedAct: this.state.selectedAct}, null),
            React.createElement(_actlist2.default, {
                key: 'activities-wrapper' + this.state.id,
                activities: this.state.activities,
                selectedAct: this.state.selectedAct,
                dayId: this.state.id,
                handleSelectActivity: this.props.handleSelectActivity
            }), element('div', { key: 'buttons-wrapper' + this.state.id, className: "form-day-buttons-wrapper" }, [element('input', { key: 'save' + this.state.id, type: "submit", value: "Save", className: "button button-primary button-small" }, null), element(_deldaybutton2.default, { key: 'del' + this.state.id, itemId: this.state.id, del: this.props.handleDayDelete }, null)]),,])]);
        }
    }]);

    return DayItem;
}(React.Component);

exports.default = DayItem;

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _actlistitem = __webpack_require__(6);

var _actlistitem2 = _interopRequireDefault(_actlistitem);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var element = React.createElement;

var ActList = function (_React$Component) {
    _inherits(ActList, _React$Component);

    function ActList(props) {
        _classCallCheck(this, ActList);

        var _this = _possibleConstructorReturn(this, (ActList.__proto__ || Object.getPrototypeOf(ActList)).call(this, props));

        _this.state = {
            activities: _this.props.activities,
            selectedAct: _this.props.selectedAct
        };
        _this.getActivitiesItemList = _this.getActivitiesItemList.bind(_this);
        return _this;
    }

    _createClass(ActList, [{
        key: 'componentWillReceiveProps',
        value: function componentWillReceiveProps(nextProps) {
            this.setState({
                activities: nextProps.activities,
                selectedAct: nextProps.selectedAct
            });
        }
    }, {
        key: 'getActivitiesItemList',
        value: function getActivitiesItemList() {
            var _this2 = this;

            var daySelectedAct = this.state.selectedAct.filter(function (act) {
                return act.dayID == _this2.props.dayId;
            });

            var activitiesItemList = daySelectedAct.map(function (act) {
                return React.createElement(_actlistitem2.default, {
                    key: 'act-item' + act.act.id,
                    id: act.act.id,
                    day: act.dayID,
                    checked: true,
                    util: _this2.props.handleSelectActivity,
                    title: act.act.title.rendered
                });
            });

            activitiesItemList.push(this.state.activities.map(function (act) {
                return React.createElement(_actlistitem2.default, {
                    id: act.id,
                    day: _this2.props.dayId,
                    checked: false,
                    util: _this2.props.handleSelectActivity,
                    title: act.title.rendered
                });
            }));

            return activitiesItemList;
        }
    }, {
        key: 'render',
        value: function render() {
            return element('ul', { className: "act-list-wrapper" }, this.getActivitiesItemList());
        }
    }]);

    return ActList;
}(React.Component);

exports.default = ActList;

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var element = React.createElement;

var DelDayButton = function (_React$Component) {
    _inherits(DelDayButton, _React$Component);

    function DelDayButton(props) {
        _classCallCheck(this, DelDayButton);

        return _possibleConstructorReturn(this, (DelDayButton.__proto__ || Object.getPrototypeOf(DelDayButton)).call(this, props));
    }

    _createClass(DelDayButton, [{
        key: 'render',
        value: function render() {
            if (this.props.itemId != '') {
                return element('a', { key: "del-day-button", onClick: this.props.del, className: "button button-secondary button-small", href: "#", id: this.props.itemId }, 'Delete');
            }
            return null;
        }
    }]);

    return DelDayButton;
}(React.Component);

exports.default = DelDayButton;

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var element = React.createElement;

var ActListItem = function (_React$Component) {
    _inherits(ActListItem, _React$Component);

    function ActListItem(props) {
        _classCallCheck(this, ActListItem);

        return _possibleConstructorReturn(this, (ActListItem.__proto__ || Object.getPrototypeOf(ActListItem)).call(this, props));
    }

    _createClass(ActListItem, [{
        key: 'render',
        value: function render() {
            return element('li', { key: 'li-' + this.props.id }, [element('input', {
                key: 'checkbox-' + this.props.id,
                type: "checkbox",
                onChange: this.props.util,
                id: this.props.id,
                name: this.props.day,
                checked: this.props.checked
            }, null), element('span', { key: 'legend' + this.props.id }, this.props.title)]);
        }
    }]);

    return ActListItem;
}(React.Component);

exports.default = ActListItem;

/***/ })
/******/ ]);